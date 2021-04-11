<?php
namespace Drupal\campusapp\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
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
		$build['placeholder']=['#markup'=>'<div id="qrcode"/>'];
		
		return $build;
	}
	
	public function LoginPageCallback(Request $request) {
		$post_array=$request->request;
		unset($post_array['signature']);
		if($request->request['signature']==campusapp_getSign($post_array, \Drupal::config('campusapp.settings')->get('apikey'))) {
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
