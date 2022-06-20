<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use App\Models\User;

use App\Models\Business;

use Session;

class CustomerAuthController extends Controller {

    public function checksignin(Request $request) {

        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return back()->with('error', 'Please enter a valid email format.');
        } else {

            $check = User::where('email', $request->email)->first();
            $count = User::where('email', $request->email)->count();

            if ($count > 0) {

                if (\Hash::check($request->password, $check->password)) {

                    $customer_id = $request->session()->put('customer_id', $check->id);
                    $customer_name = $request->session()->put('customer_name', $check->name);
                    $customer_email = $request->session()->put('customer_email', $check->email);
                    return redirect()->route('profile')->with('info', "Login Successfully.");

                } else {
                    return back()->with('error', 'Email or password is invalid.');
                }

            } else {
                return back()->with('error', 'Email or password is invalid.');
            }

        }

    }

    public function accountsignup(Request $request) {

        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()->with('error', 'Please Enter a Valid Email.');
        } else if(trim($request->password) != trim($request->confirm_password)) {
            return redirect()->back()->with('error', 'Passwords does not match');
        } else {

            $check = User::where('email', $request->email)->count();

            if ($check > 0) {
                return redirect()->back()->with('error', 'Email Already Registered.');
            } else {

                $user = new User;

                $user->name = $request->name;

                $user->profile = "https://420finder.net/assets/img/logo.png";

                $user->email = $request->email;

                $user->password = Hash::make($request->password);

                if ($user->save()) {

                  $business = new Business;

                  $business->business_name = $request->name;

                  $business->email = $request->email;

                  $business->business_type = 'Brand';

                  $business->license_type = 'Medical Cultivation';

                  $business->profile_picture = "https://420finder.net/assets/img/logo.png";

                  $business->password = Hash::make($request->password);

                  $business->status = 1;

                  $business->save();

                    $to = $request->email;
                    $emailBody = '
                        <html>
                            <head>
                                <title>WELCOME</title>
                                <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                                <meta name="viewport" content="width=device-width, initial-scale=1.0 ">
                                <meta name="format-detection" content="telephone=no">
                                <!--[if !mso]><!-->
                                <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
                                <!--<![endif]-->
                                <style type="text/css">
                                  body {
                                  -webkit-text-size-adjust: 100% !important;
                                  -ms-text-size-adjust: 100% !important;
                                  -webkit-font-smoothing: antialiased !important;
                                  }
                                  img {
                                  border: 0 !important;
                                  outline: none !important;
                                  }
                                  p {
                                  Margin: 0px !important;
                                  Padding: 0px !important;
                                  }
                                  table {
                                  border-collapse: collapse;
                                  mso-table-lspace: 0px;
                                  mso-table-rspace: 0px;
                                  }
                                  td, a, span {
                                  border-collapse: collapse;
                                  mso-line-height-rule: exactly;
                                  }
                                  .ExternalClass * {
                                  line-height: 100%;
                                  }
                                  span.MsoHyperlink {
                                  mso-style-priority:99;
                                  color:inherit;}
                                  span.MsoHyperlinkFollowed {
                                  mso-style-priority:99;
                                  color:inherit;}
                                  </style>
                                  <style media="only screen and (min-width:481px) and (max-width:599px)" type="text/css">
                                  @media only screen and (min-width:481px) and (max-width:599px) {
                                  table[class=em_main_table] {
                                  width: 100% !important;
                                  }
                                  table[class=em_wrapper] {
                                  width: 100% !important;
                                  }
                                  td[class=em_hide], br[class=em_hide] {
                                  display: none !important;
                                  }
                                  img[class=em_full_img] {
                                  width: 100% !important;
                                  height: auto !important;
                                  }
                                  td[class=em_align_cent] {
                                  text-align: center !important;
                                  }
                                  td[class=em_aside]{
                                  padding-left:10px !important;
                                  padding-right:10px !important;
                                  }
                                  td[class=em_height]{
                                  height: 20px !important;
                                  }
                                  td[class=em_font]{
                                  font-size:14px !important;
                                  }
                                  td[class=em_align_cent1] {
                                  text-align: center !important;
                                  padding-bottom: 10px !important;
                                  }
                                  }
                                  </style>
                                  <style media="only screen and (max-width:480px)" type="text/css">
                                  @media only screen and (max-width:480px) {
                                  table[class=em_main_table] {
                                  width: 100% !important;
                                  }
                                  table[class=em_wrapper] {
                                  width: 100% !important;
                                  }
                                  td[class=em_hide], br[class=em_hide], span[class=em_hide] {
                                  display: none !important;
                                  }
                                  img[class=em_full_img] {
                                  width: 100% !important;
                                  height: auto !important;
                                  }
                                  td[class=em_align_cent] {
                                  text-align: center !important;
                                  }
                                  td[class=em_align_cent1] {
                                  text-align: center !important;
                                  padding-bottom: 10px !important;
                                  }
                                  td[class=em_height]{
                                  height: 20px !important;
                                  }
                                  td[class=em_aside]{
                                  padding-left:10px !important;
                                  padding-right:10px !important;
                                  }
                                  td[class=em_font]{
                                  font-size:14px !important;
                                  line-height:28px !important;
                                  }
                                  span[class=em_br]{
                                  display:block !important;
                                  }
                                  }
                                </style>
                            </head>
                            <body style="margin:0px; padding:0px;" bgcolor="#ffffff">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
                                    <tbody>
                                        <tr>
                                            <td align="center" valign="top" bgcolor="#f9f9f9" class="">
                                              <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="em_main_table" style="table-layout:fixed;margin: 40px 0 40px 0;">
                                                <tbody style="background: #ffffff;" bgcolor="#f9f9f9"><tr>
                                                  <td height="40" class="em_height">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                  <td align="center"><a href="#" target="_blank" style="text-decoration:none;" class=""><img src="' . asset('assets/img/logo.png') . '" width="" style="display:block;font-family: Arial, sans-serif;font-size:15px;color:#30373b;font-weight:bold;width: 40%;" border="0" alt="LoGo Here" class=""></a></td>
                                                </tr>
                                                <tr style="border-bottom: 1px solid #e3e3e3;">
                                                  <td height="30" class="em_height">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                  <td valign="top" class="em_aside">
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                      <tbody>



                                                      <tr>
                                                        <td height="35" class="em_height">&nbsp;</td>
                                                      </tr>
                                                      <tr>
                                                        <td align="center" style="font-size: 14px;line-height:18px;color:#30373b;padding: 0 20px;">
                                                            <h2>Welcome to 420 Finder</h2>
                                                            <p>Start browsing your favourite style type of products.</p>
                                                        </td>
                                                      </tr>
                                                      <tr>
                                                        <td height="22" style="font-size:1px; line-height:1px;">&nbsp;</td>
                                                      </tr>
                                                      <tr>
                                                        <td height="12" style="font-size:1px; line-height:1px;">&nbsp;</td>
                                                      </tr><tr style="background: #F8971C;">
                                                        <td align="center" style="font-family:Arial, sans-serif;font-size: 14px;font-weight:bold;line-height:18px;color: #ffffff;line-height: 5;">© 2021 <a href="" style="color: #ffffff;font-weight: 900;text-decoration: none;">420finder.com</a>. All Rights Reserved.</td>
                                                      </tr>
                                                    </tbody></table>
                                                  </td>
                                                </tr>
                                              </tbody></table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div style="display:none; white-space:nowrap; font:20px courier; color:#ffffff; background-color:#ffffff;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>


                            </body>
                        </html>
                    ';

                    $from = "info@420finder.com";
                    $subject = "Welcome to 420 Finder";
                    // To send HTML mail, the Content-type header must be set
                    $headers  = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                    // Create email headers
                    $headers .= 'From: '.$from."\r\n".
                        'Reply-To: '.$from."\r\n" .
                        'X-Mailer: PHP/' . phpversion();

                    // mail($to, $subject, $emailBody, $headers);// Mail to Customer

                    $customer_id = $request->session()->put('customer_id', $user->id);
                    $customer_name = $request->session()->put('customer_name', $user->name);
                    return redirect()->route('profile');

                } else {
                    return redirect()->back()->with('error', 'Something Went Wrong.');
                }

            }

        }

    }

    public function logout() {

        session()->forget('customer_name');
        session()->forget('customer_id');

        return redirect()->route('signin');

    }

}
