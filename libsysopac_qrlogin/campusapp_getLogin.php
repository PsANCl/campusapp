<?php
$filename=sprintf('%s/%s.txt', sys_get_temp_dir(), $_GET['uid']);

$result=new stdClass();
if($_SERVER['REQUEST_METHOD']=='GET') {
        if(file_exists($filename)) {
                $conn=oci_connect('libsys', 'libsys', '172.16.250.169/orcl');
                if(!$conn) break;
                $redr_cert_id=file_get_contents($filename);
                $stid = oci_parse($conn, 'SELECT CERT_ID FROM READER_CERT WHERE REDR_CERT_ID=:redr_cert_id');
                oci_bind_by_name($stid, ":redr_cert_id", $redr_cert_id);
                oci_define_by_name($stid, 'CERT_ID', $certid);
                oci_execute($stid);
                oci_fetch($stid);
                if(!empty($certid)) {
                        $result->success=1;
                        $result->certId=$certid;
                }
                oci_free_statement($stid);
                oci_close($conn);
                unlink($filename);
        }
} else {
        file_put_contents($filename, $_POST['xgh']);
        $result->e='9999';
        $result->m=$filename;
}
header('Content-type: application/json');
echo json_encode($result);
?>
