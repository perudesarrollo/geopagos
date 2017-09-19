<pre>
<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('America/Lima');

define('DB_HOST', getenv('DB_PORT_3305_TCP_ADDR'));
define('DB_NAME', 'geopagos_exm1');
define('DB_USER', 'root');
define('DB_PASS', getenv('DB_ENV_MYSQL_ROOT_PASSWORD'));
define('DB_PORT', getenv('MARIADB_PORT_3306_TCP_PORT'));

require_once 'modelo.php';
require_once 'usuario.php';
require_once 'usuariofavoritos.php';
require_once 'pago.php';
require_once 'usuariopagos.php';

$modelo          = new Modelo();
$usuario         = new Usuario();
$usuarioFavorito = new UsuarioFavoritos();
$pago            = new Pago();
$usuarioPago     = new UsuarioPagos();

$opcion = @$_GET['opcion'];
switch ($opcion) {
case 'usuario':

    $v_usuario = @$_GET['u'];
    $v_clave   = @$_GET['c'];
    $v_edad    = @$_GET['e'];

    $user = $usuario->setUsuario($v_usuario)
        ->setClave($v_clave)
        ->setEdad($v_edad, 18);

    $existe_usuario = $modelo->select('usuarios', 'usuario = ?', array($usuario->getUsuario()), 'limit 1');
    $existe         = $existe_usuario->fetch(PDO::FETCH_OBJ);
    if (!$existe) {
        $modelo->insertar($user, 'usuarios');
        $data = $modelo->select('usuarios');
        echo "Guardado!!! :)\nLista::\n";
        print_r($data->fetchAll(PDO::FETCH_OBJ));
    } else {
        echo "Usuario ({$v_usuario}) ya existe.";
    }
    break;

case 'favoritos':

    $v_id_usuario          = @$_GET['u'];
    $v_id_usuario_favorito = @$_GET['fu'];

    $fav = $usuarioFavorito->setCodigoUsuario($v_id_usuario)
        ->setCodigoFavorito($v_id_usuario_favorito);

    $param  = [$v_id_usuario, $v_id_usuario_favorito];
    $existe = $modelo->select('usuarios', 'codigousuario IN(?,?)', $param);
    $existe = $existe->fetchAll(PDO::FETCH_OBJ);
    if ($existe) {
        $exit_fav = $modelo->select('favoritos', 'codigousuario = ? AND codigousuariofavorito = ?', $param);
        $exit_fav = $exit_fav->fetch(PDO::FETCH_OBJ);
        if (!$exit_fav) {
            $modelo->insertar($fav, 'favoritos');
            $data = $modelo->select('favoritos');
            echo "Guardado!!! :)\nLista::\n";
            print_r($data->fetchAll(PDO::FETCH_OBJ));
        } else {
            echo "Ya están registrados los usuarios ({$v_id_usuario},{$v_id_usuario_favorito}).";
        }

    } else {
        echo "Alguno de los usuarios no están registrados.";
    }
    break;

case 'pagos':

    $v_importe = @$_GET['i'];
    $v_fecha   = @$_GET['f'];

    $pag = $pago->setImporte($v_importe)
        ->setFecha($v_fecha);

    $modelo->insertar($pag, 'pagos');
    $data = $modelo->select('pagos');
    echo "Guardado!!! :)\nLista::\n";
    print_r($data->fetchAll(PDO::FETCH_OBJ));
    break;

case 'usuariospagos':

    $v_id_usuario = @$_GET['u'];
    $v_id_pago    = @$_GET['p'];

    $pagosusuario = $usuarioPago->setCodigoUsuario($v_id_usuario)
        ->setCodigoPago($v_id_pago);

    $exis_user = $modelo->select('usuarios', 'codigousuario = ?', [$v_id_usuario]);
    $exis_user = $exis_user->fetch(PDO::FETCH_OBJ);

    $exis_pag = $modelo->select('pagos', 'codigopago = ?', [$v_id_pago]);
    $exis_pag = $exis_pag->fetch(PDO::FETCH_OBJ);

    if ($exis_user && $exis_pag) {
        $param = [$v_id_pago, $v_id_usuario];
        $exite = $modelo->select('usuariospagos', 'codigopago = ? AND codigousuario = ?', $param);
        $exite = $exite->fetch(PDO::FETCH_OBJ);
        if (!$exite) {
            $modelo->insertar($pagosusuario, 'usuariospagos');
            $data = $modelo->select('usuariospagos');
            echo "Guardado!!! :)\nLista::\n";
            print_r($data->fetchAll(PDO::FETCH_OBJ));
        } else {
            echo "Ya están registrados los códigos ({$v_id_usuario},{$v_id_pago}).";
        }
    } else {
        echo "Alguno de los Códigos no están registrados.";
    }
    break;

default:
    echo "Datos Vacíos.";
    break;
}

//echo phpinfo();
?>
</pre>