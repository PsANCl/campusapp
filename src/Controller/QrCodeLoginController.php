<?php
namespace Drupal\campusapp\Controller;

use Drupal\Core\Controller\ControllerBase;

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
}
?>
