<?php

namespace Modules\Auth\Http\Controllers\Api;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Modules\Auth\Entities\UserVerification;
use Modules\Auth\Entities\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    function fireSMS($number, $msg)
    {
        $number = Str::replaceFirst('0', '966', $number);
        $msg = str_replace(" ", '%20', $msg);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://ht.deewan.sa:8443/Send.aspx?UserName=FITBUDDY&Password=a3Lt5F&MessageType=text&Recipients=$number&SenderName=FIT%20BUDDY&MessageText=$msg",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // echo $response;
    }
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'mobile' => 'required|unique:users,mobile|numeric',
            'password' => 'required|string',
            'firebase_token' => 'nullable|string',
            'length' => 'required|string',
            'weight' => 'required|string',
            'age' => 'required|string',
            'notes' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()->all(),
                'data' => [],
            ]);
        }
        $emialex = User::where('email', $request->email)->get();
        $mobileex = User::where('mobile', $request->mobile)->get();

        if (isset($emialex) && count($emialex) > 0) {
            return response()->json([
                'status' => false,
                'message' => 'email exist',
                'data' => [],
                'errors' => ['email exists'],
            ], 200);
        }
        if (isset($mobileex) && count($mobileex) > 0) {
            return response()->json([
                'status' => false,
                'message' => 'phone exist',
                'data' => [],
                'errors' => ['phone exists'],
            ], 200);
        }

        $digits = 6;
        $verify_code = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
        $jwt = str_random(20);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password),
            'firebase_token' => $request->firebase_token,
            'jwt' => $jwt,
            'length' => $request->length,
            'weight' =>  $request->weight,
            'age' =>  $request->age,
            'notes' => $request->notes
        ]);
        // $user->save();
        $newcode = new UserVerification();
        $newcode->verifications_code = $verify_code;
        $newcode->user_id = $user->id;
        $newcode->save();
        
        $msg = "your activation code is :" . $verify_code;
        //        $this->SendYamSMS($user->mobile , $msg);
        $this->fireSMS($request->mobile, $msg);

        return response()->json([
            'status' => true,
            'message' => 'Successfully created user!',
            'data' => [],
            'errors' => [],
            'jwt' => $user->jwt,
            'code' => $verify_code,
        ], 200);

    }
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function Login(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'key' => 'required',
                'password' => 'required',
                'firebase_token' => 'required',

            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'msg' => $validator->messages()->all()]);
        }



        $user = User::where('email', $request->key)->
        orWhere('mobile',$request->key)->first();
        if (!$user) {
            //            return response()->json(res_msg($request->header('lang'), failed(), 404, 'user_not_found'));
            return response()->json([
                'status' => false,
                'message' => 'user not found',
                'data' => [],
                'errors' => ['user not found'],
            ], 200);
        }


        $check = Hash::check($request->password, $user->password);

        if ($check) {

            if ($user->verified_status == 0) {
                //                $this->authObject->Sendverificationcode($user);
                //                return response()->json(res_msg($request->header('lang'), failed(), 405, 'user_not_verified'));
                return response()->json([
                    'status' => true,
                    'message' => 'user not verified',
                    'data' => ["verified_status"=>$user->verified_status],
                    'errors' => ['user not verified'],
                ], 200);

                $newcode = new UserVerification();
                $newcode->verifications_code = $verify_code;
                $newcode->user_id = $user->id;
                $newcode->save();
                $msg = "your activation code is :" . $verify_code;
                $this->fireSMS($user->mobile, $msg);
            }
            $jwt = str_random(20);
            $user->update(array('jwt' => $jwt, 'firebase_token' => $request->firebase_token));
            $user->logged = 1;
            $user->save();
            //
            //            return response()->json(res_msg($request->header('lang'), success(), 200, 'logged_in', $user));
            return response()->json([
                'status' => true,
                'message' => 'Successfully logged in!',
                'data' => $user,
                'errors' => [],
            ], 200);
        } else {
            //            return response()->json(res_msg($request->header('lang'), failed(), 401, 'invalid_password'));
            return response()->json([
                'status' => false,
                'message' => 'invalid password',
                'data' => [],
                'errors' => ['invalid password'],
            ], 200);
        }
    }
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function SendVerificationCode(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            ['phone' => 'required',]
        );
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'msg' => $validator->messages()->all()]);
        }
        $usertoverify = User::where('mobile', $request->phone)->first();
        if (isset($usertoverify)) {
            $usertoverify->verified_status = 0;
            $usertoverify->save();
            $verification = new UserVerification();
            $verification->user_id = $usertoverify->id;
            $digits = 4;
            $code = rand(pow(10, $digits - 1), pow(10, $digits) - 1);

            $verification->verifications_code = $code;
            $verification->save();

            if ($verification == 'code_sent') {
                //            return response(res_msg($request->header('Lang'), success(), 200, 'code_sent'));
                $msg = "your activation code is :" . $verify_code;
                //        $this->SendYamSMS($user->mobile , $msg);
                $this->fireSMS($usertoverify->mobile, $msg);
                return response()->json([
                    'status' => true,
                    'message' => 'code sent',
                    'code' => $code,
                    'errors' => [],
                    'data' => [],
                ]);
            } else {
                //            return response(res_msg($request->header('Lang'), failed(), 404, 'user_not_found'));
                return response()->json([
                    'status' => false,
                    'message' => 'user not found',
                    'errors' => [],
                    'data' => [],
                ]);
            }
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function VerifyCode(Request $request)
    {
        $verificationcode = UserVerification::where('verifications_code', $request->verifications_code)->first();
        if (isset($verificationcode)) {
            $usertoverify = User::where('id', $verificationcode->user_id)->first();
            if ($usertoverify->verified_status == 0) {
                $verificationcode->delete();
                $usertoverify->verified_status = 1;
                $usertoverify->save();
                $response = [
                    'message' => "user verification account successfully",
                    'code' => 200,
                    'status' => true,
                    'data' => $usertoverify->makeHidden(['password']),
                    'errors' => [],
                ];
                return \Response::json($response, 200);
            } else {
                $verificationcode->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'user already verified',
                    'errors' => [],
                    'data' => $usertoverify,
                ]);
            }
        } else {
            //    return 'invalid_code';
            return response()->json([
                'status' => true,
                'message' => 'invalid code',
                'errors' => [],
                'data' => [],
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function logout(Request $request)
    {
        // Get JWT Token from the request header key "Authorization"
        $jwt = ($request->hasHeader('Jwt')) ? $request->header('Jwt') : false;
        $user = User::where('jwt', $jwt)->first();
        // Invalidate the token
        if ($user) {
            $user->jwt = '';
            $user->logged = '0';
            $user->save();
            $response = [
                'message' => "user logged out successfully",
                'code' => 200,
                'status' => true,
            ];
            return \Response::json($response, 200);
        } else {
            return $response = [
                'success' => 200,
                'message' => 'Something_went_wrong.',
                'errors' => ["Sorry! Something went wrong."],
            ];
            return \Response::json($response, 200);
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function ChangePassword(Request $request)
    {

        $validator = Validator::make($request->all(), array('password' => 'required', 'old_password' => 'required'));
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->messages()->all()]);
        }
        $jwt = ($request->hasHeader('Jwt')) ? $request->header('Jwt') : false;

        $user = User::where('jwt', $jwt)->first();
        if (isset($user->id)) {
            $request['id'] = $user->id;
            $flag = User::where('jwt', $jwt)->first();
            if (isset($request->old_password)) {
                $check = Hash::check($request->old_password, $user->password);
                if (!$check) {
                    return 'invalid_oldpassword';
                }
            }
            $user->password = Hash::make($request->password);
            $user->save();
            if (isset($flag->id)) {
                $response = [
                    'code' => 200,
                    'status' => true,
                    'message' => 'password_changed',
                ];
                return \Response::json($response, 200);
            } elseif ($flag == "invalid_oldpassword") {
                $response = [
                    'code' => 200,
                    'status' => false,
                    'message' => 'invalid_oldpassword',
                    'errors' => ["invalid old password"]
                ];
                return \Response::json($response, 200);
            }
        } else {
            $response = [
                'code' => 200,
                'status' => false,
                'message' => 'user_not_found',
                'errors' => ["user not found"]
            ];
            return \Response::json($response, 200);
        }
    }
    public function forgetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), array('email' => 'required',));
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()->all()]);
        }
        $user = User::where('email',  $request->input('email'))->first();

        if (!empty($user)) {
            $usertoverify = User::where('email', $request->email)
                ->orWhere('mobile', $request->phone)->first();
            if (isset($usertoverify)) {
                $usertoverify->verified_status = 0;
                $usertoverify->save();
                $verification_Ob = new UserVerification();

                $verification_Ob->user_id = $usertoverify->id;
                $digits = 6;
                $code = rand(pow(10, $digits - 1), pow(10, $digits) - 1);

                $verification_Ob->verifications_code = $code;
                $verification_Ob->save();
                //                $data = array('name'=>$usertoverify->name,'code'=>$code);
                //
                //                Mail::send('dashboard.CheckMail.mail', $data, function($message)use($usertoverify) {
                //                    $message->to($usertoverify->email)->subject
                //                    ('Verification Code');
                //                    $message->from('test@scriptplus.net','anaat Application');
                //                });

                //                return 'code_sent';
                $response = [
                    'message' => 'code sent',
                    'status' => true,
                    'data' => $code,
                ];
                return \Response::json($response, 200);
            } else {
                //                return "user_not_found";
                $response = [
                    'message' => 'user not found',
                    'status' => false,
                    'errors' => ["email not found"]
                ];
                return \Response::json($response, 200);
            }

            $getverification = UserVerification::where('user_id', $usertoverify->id)->select('verifications_code')->first();
            $this->sms($user, $getverification->verification_code, true);
            $response = [
                'message' => 'user is exist',
                'status' => true,
                'data' => []
            ];
            return \Response::json($response, 200);
        } else {
            $response = [
                'message' => 'user not found',
                'status' => false,
                'errors' => ["email not found"]
            ];
            return \Response::json($response, 200);
        }
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            array('email' => 'required', 'password' => 'required', 'password_confirmation' => 'required', 'verification_code' => 'required')
        );
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()->all()]);
        }

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return $response = [
                'code' => 403,
                'status' => false,
                'message' => 'not registered',
                'errors' => ["user not found"]
            ];
        }

        $flag = UserVerification::where('Verifications_code', $request->verification_code)->first();
        if (isset($flag)) {
            $usertoverify = User::where('id', $flag->user_id)->first();
            if ($usertoverify->verified_status == 0) {
                $flag->delete();
                $usertoverify->verified_status = 1;
                $usertoverify->save();
                //                return  'activated';
                $response = [
                    'message' => 'activated',
                    'code' => 200,
                    'status' => true,
                    'data' => [],
                ];

                return \Response::json($response, 200);
            } else {
                $flag->delete();
                //                return 'user_already_verified';
                $response = [
                    'message' => 'user already verified',
                    'code' => 404,
                    'status' => false,
                ];

                return \Response::json($response, 200);
            }
        } else {
            //            return 'invalid_code';
            $response = [
                'message' => 'invalid code',
                'code' => 404,
                'status' => false,
            ];

            return \Response::json($response, 200);
        }

        if ($flag == 'activated') {

            if ($request->password != null && ($request->password == $request->password_confirmation)) {
                $user->password = Hash::make($request->password_confirmation);

                if ($user->save()) {
                    $response = [
                        'message' => 'password changed successfully',
                        'code' => 200,
                        'status' => true,
                        'data' => [],
                    ];
                }
                return \Response::json($response, 200);
            } else {
                $response = [
                    'message' => 'something went wrong',
                    'code' => 400,
                    'status' => false,
                ];

                return \Response::json($response, 200);
            }
        } elseif ($flag == 'invalid_code') {
            $response = [
                'code' => 401,
                'status' => false,
                'message' => 'invalid_code',
                'errors' => ["invalid code"],
            ];
            return \Response::json($response, 200);
        }
    }
}
