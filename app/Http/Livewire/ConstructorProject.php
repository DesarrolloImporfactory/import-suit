<?php

namespace App\Http\Livewire;

use Livewire\Component;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Connection;
use Illuminate\Support\Str;

class ConstructorProject extends Component
{
    public $subdominio, $paso1;
    protected $listeners = ['form2'];

    public function render()
    {
        return view('livewire.constructor-project');
    }

    public function form()
    {
        try {
            $subd1 = $this->subdominio;
            // Configuración de la API de cPanel
            $cpanelUrl = 'https://imporsuit.com:2083/';
            $cpanelUsername = 'imporsuit';
            $cpanelPassword = '09992631072demasiado.';
            $subdomain = $subd1;
            // Datos para la solicitud
            $data = array(
                'name' => $subdomain,
                'repository_root' => '/home/imporsuit/public_html/' . $subdomain,
                'source_repository' => '{"imporsuitv01":"origin","url":"https://github.com/EduardoVega86/imporsuitv01"}',
            );
            // URL de la API para agregar subdominios
            $apiUrl = $cpanelUrl . '/cpsess' . session_id() . '/execute/VersionControl/create?type=git&name=' . $subdomain . '&repository_root=%2fhome%2fimporsuit%2fpublic_html%2f' . $subdomain . '&source_repository={"imporsuitv01":"origin","url":"https://github.com/EduardoVega86/imporsuitv01"}';

            // Inicializar cURL
            $ch = curl_init($apiUrl);

            // Configurar las opciones de cURL
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Desactivar en producción, habilita la verificación SSL
            curl_setopt($ch, CURLOPT_USERPWD, $cpanelUsername . ':' . $cpanelPassword);

            // Ejecutar la solicitud
            $response = curl_exec($ch);

            // Verificar si hubo errores
            if (curl_errno($ch)) {
                dd('Error al hacer la solicitud cURL: ' . curl_error($ch));
            } else {
                // Analizar la respuesta JSON si es necesario
                $responseData = json_decode($response, true);

                // Hacer algo con la respuesta (puede variar según la respuesta de la API)
                $this->paso1 = 'ok';
                $this->emit('alert1', $this->subdominio);
                // $this->form2($this->subdominio);
            }

            // Cerrar la sesión cURL
            curl_close($ch);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function form2($subdominio)
    {
        $subd1 = $subdominio;
        // Configuración de la API de cPanel
        $cpanelUrl = 'https://imporsuit.com:2083/'; // Reemplaza con la URL de tu cPanel
        $cpanelUsername = 'imporsuit';
        $cpanelPassword = '09992631072demasiado.';

        // Datos del subdominio a crear
        $subdomain = $subd1;
        $rootdomain = 'imporsuit.com';

        // URL de la API para agregar subdominios
        $apiUrl = $cpanelUrl . '/cpsess' . session_id() . '/execute/SubDomain/addsubdomain?domain=' . $subdomain . '&rootdomain=' . $rootdomain;

        // Inicializar cURL
        $ch = curl_init($apiUrl);

        // Configurar las opciones de cURL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Desactivar en producción, habilita la verificación SSL
        curl_setopt($ch, CURLOPT_USERPWD, $cpanelUsername . ':' . $cpanelPassword);

        // Ejecutar la solicitud
        $response = curl_exec($ch);

        // Verificar si hubo errores
        if (curl_errno($ch)) {
            dd('Error al hacer la solicitud cURL: ' . curl_error($ch));
        } else {
            // Analizar la respuesta JSON si es necesario
            $responseData = json_decode($response, true);

            // Hacer algo con la respuesta (puede variar según la respuesta de la API)
            $this->emit('alert', 'form2 ok');
            $this->form3($subdominio);
        }

        // Cerrar la sesión cURL
        curl_close($ch);
    }

    public function form3($subdominio)
    {
        $subd1 = $subdominio;
        $cpanelUrl = 'https://imporsuit.com:2083/';
        $cpanelUsername = 'imporsuit';
        $cpanelPassword = '09992631072demasiado.';
        $databaseName = "imporsuit_$subd1";
        $apiUrl = $cpanelUrl . '/cpsess' . session_id() . '/execute/Mysql/create_database?name=' . $databaseName;
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_USERPWD, $cpanelUsername . ':' . $cpanelPassword);
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            dd('Error al hacer la solicitud cURL: ' . curl_error($ch));
        } else {
            $responseData = json_decode($response, true);
            $this->emit('alert', 'form3 ok');
            $this->form4($subdominio);
        }
        curl_close($ch);
    }

    public function form4($subdominio)
    {
        $subd1 = $subdominio;
        // Configuración de la API de cPanel
        $cpanelUrl = 'https://imporsuit.com:2083/'; // Reemplaza con la URL de tu cPanel
        $cpanelUsername = 'imporsuit';
        $cpanelPassword = '09992631072demasiado.';

        // Datos del subdominio a crear
        $subdomain = $subd1;

        // URL de la API para agregar subdominios
        $apiUrl = $cpanelUrl . '/cpsess' . session_id() . '/execute/Mysql/create_user?name=imporsuit_' . $subdomain . '&password=imporsuit_' . $subdomain;

        // Inicializar cURL
        $ch = curl_init($apiUrl);

        // Configurar las opciones de cURL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); // Desactivar en producción, habilita la verificación SSL
        curl_setopt($ch, CURLOPT_USERPWD, $cpanelUsername . ':' . $cpanelPassword);

        // Ejecutar la solicitud
        $response = curl_exec($ch);

        // Verificar si hubo errores
        if (curl_errno($ch)) {
            dd('Error al hacer la solicitud cURL: ' . curl_error($ch));
        } else {
            // Analizar la respuesta JSON si es necesario
            $responseData = json_decode($response, true);

            // Hacer algo con la respuesta (puede variar según la respuesta de la API)
            $this->emit('alert', 'form4 ok');
            $this->form5($subdominio);
        }

        // Cerrar la sesión cURL
        curl_close($ch);
    }

    public function form5($subdominio)
    {
        $subd1 = $subdominio;
        // Configuración de la API de cPanel
        $cpanelUrl = 'https://imporsuit.com:2083/'; // Reemplaza con la URL de tu cPanel
        $cpanelUsername = 'imporsuit';
        $cpanelPassword = '09992631072demasiado.';

        // Datos del subdominio a crear
        $subdomain = $subd1;

        // URL de la API para agregar subdominios
        $apiUrl = $cpanelUrl . '/cpsess' . session_id() . '/execute/Mysql/set_privileges_on_database?user=imporsuit_' . $subdomain . '&database=imporsuit_' . $subdomain . '&privileges=ALL';

        // Inicializar cURL
        $ch = curl_init($apiUrl);

        // Configurar las opciones de cURL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); // Desactivar en producción, habilita la verificación SSL
        curl_setopt($ch, CURLOPT_USERPWD, $cpanelUsername . ':' . $cpanelPassword);

        // Ejecutar la solicitud
        $response = curl_exec($ch);

        // Verificar si hubo errores
        if (curl_errno($ch)) {
            dd('Error al hacer la solicitud cURL: ' . curl_error($ch));
        } else {
            // Analizar la respuesta JSON si es necesario
            $responseData = json_decode($response, true);

            // Hacer algo con la respuesta (puede variar según la respuesta de la API)
            $this->emit('alert', 'form5 ok');
            $this->form6($subdominio);
        }

        // Cerrar la sesión cURL
        curl_close($ch);
    }

    public function form6($subdominio)
    {
        try {
            $subd1 = $subdominio;

            // Configura la conexión a la base de datos
            $config = [
                'driver' => 'mysql',
                'host' => '158.220.107.176',
                'port' => 3306,
                'database' => 'imporsuit_' . $subd1,
                'username' => 'imporsuit_' . $subd1,
                'password' => 'imporsuit_' . $subd1,
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
            ];

            // Modifica la configuración de la base de datos en tiempo de ejecución
            Config::set('database.connections.mysql', $config);

            // Conecta a la base de datos y limpia las tablas
            DB::purge('mysql');
            DB::reconnect('mysql');

            $tables = DB::select('SHOW TABLES');

            foreach ($tables as $table) {
                $table_array = get_object_vars($table);
                $table_name = reset($table_array);

                DB::table($table_name)->truncate();
            }

            // Lee el script SQL
            $sqlFilePath = public_path('import_tienda.sql');
            $sqlScript = file($sqlFilePath);
            $query = '';

            // Ejecuta las consultas SQL
            foreach ($sqlScript as $line) {
                $startWith = substr(trim($line), 0, 2);
                $endWith = substr(trim($line), -1, 1);

                if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
                    continue;
                }

                $query = $query . $line;
                if ($endWith == ';') {
                    DB::statement($query); // Utiliza DB::statement para ejecutar consultas SQL directas
                    $query = '';
                }
            }

            $this->form7($subdominio);
            dd('find');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function form7($subdominio)
    {
        try {
            $subd1 = $subdominio;
            $cpanelUrl = 'https://imporsuit.com:2083/';
            $cpanelUsername = 'imporsuit';
            $cpanelPassword = '09992631072demasiado.';
            $token = '3KW3L24S5217YB54QGPTVBN8469LP1NP';

            $authData = array(
                'user' => $cpanelUsername,
                'pass' => $cpanelPassword,
            );


            $fileData = array(
                'file-1' => "@/home/imporsuit/public_html/$subd1/sysadmin/vistas/db.php",
                'dir' => "/home/imporsuit/public_html/$subd1/sysadmin/vistas/",
            );


            $chAuth = curl_init($cpanelUrl . '?login=' . $cpanelUsername . '&password=' . $cpanelPassword);
            curl_setopt($chAuth, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($chAuth, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($chAuth, CURLOPT_COOKIEJAR, '/tmp/cpanel_cookie.txt');
            $responseAuth = curl_exec($chAuth);


            if ($responseAuth === false) {
                dd('Error al autenticar en cPanel: ' . curl_error($chAuth));
                exit;
            }

            curl_close($chAuth);

            $archivo = "/home/imporsuit/public_html/$subd1/sysadmin/vistas/db.php";
            $contenido = file_get_contents($archivo);
            $nuevaLinea = "imporsuit_$subd1";
            $contenido = str_replace('imporsuit_alvitorsa', $nuevaLinea, $contenido);

            file_put_contents($archivo, $contenido);

            $chUpload = curl_init($cpanelUrl . '&token=' . $token);
            curl_setopt($chUpload, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($chUpload, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($chUpload, CURLOPT_POST, true);
            curl_setopt($chUpload, CURLOPT_POSTFIELDS, $fileData);
            curl_setopt($chUpload, CURLOPT_COOKIEFILE, '/tmp/cpanel_cookie.txt');

            $responseUpload = curl_exec($chUpload);

            if ($responseUpload === false) {
                dd('Error al cargar el archivo: ' . curl_error($chUpload));
            } else {
                dd('Archivo cargado y modificado con éxito.');
            }

            curl_close($chUpload);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
