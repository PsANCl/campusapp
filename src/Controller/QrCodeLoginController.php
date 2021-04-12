<?php
namespace Drupal\campusapp\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\user\UserData;
use Drupal\qyweixin\CorpBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Controller routines for qrcode login form.
 */
class QrCodeLoginController extends ControllerBase {
	public function LoginPage() {
		$build=[];
		$build['#attached']['library'][] = 'campusapp/campusapp-qrlogin';
		$build['#cache']=[
			'max-age' => 0,
		];
		$build['#theme']='user-login-campusapp';
		$build['placeholder']=['#markup'=>'<div id="qrcode"/>'];
		
		return $build;
	}
	
	public function LoginPageCallback(Request $request) {
		$post_array=$request->request->all();
                \Drupal::logger('campusapp')->debug('Session: @session. Userid: @userid.',
			['@session'=>$post_array['ext']['session'], '@userid'=>$post_array['xgh']]
		);
		if($post_array['signature']==campusapp_getSign($post_array['ext'], \Drupal::config('campusapp.settings')->get('apikey'))) {
			$userid=$post_array['xgh'];
			\Drupal::moduleHandler()->alter('qyweixin_to_username', $userid);
			\Drupal::state()->set('campusapp.session.'.$post_array['ext']['session'], $userid);
			$user=user_load_by_name($userid);
			if($user==FALSE) {
				$openid=CorpBase::userConvertToOpenid($userid);
			}
			$result=[
				'e'=>9999,
				'm'=>''
			];
			$response=new JsonResponse($result);
			return $response;
		} else {
			return BadRequestHttpException();
		}
	}
	
	public function LoginResult(Request $request) {
		$response=new JsonResponse($result);
		return $response;
	}
}
?>
