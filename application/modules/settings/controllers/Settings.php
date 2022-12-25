<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('sma');
        if (!$this->ion_auth->in_group('admin')) {
            redirect('home/permission');
        }
    }

    public function index() {

        $data = array();
        $data['timezones'] = $this->gmtTime();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard'); 
        $this->load->view('settings', $data);
        $this->load->view('home/footer'); 
    }

    public function update() {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $title = $this->input->post('title');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $currency = $this->input->post('currency');
        $live_appointment_type = $this->input->post('live_appointment_type');
        $logo = $this->input->post('logo');
        $footer_message = $this->input->post('footer_message');
        $buyer = $this->input->post('buyer');
        $p_code = $this->input->post('p_code');
        $show_odontogram_in_history=$this->input->post('show_odontogram_in_history');
        $timzone = $this->input->post('timezone');
        if (!empty($email)) {
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            // Validating Name Field
            $this->form_validation->set_rules('name', 'System Name', 'trim|required|min_length[1]|max_length[100]|xss_clean');
            // Validating Title Field
            $this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[1]|max_length[100]|xss_clean');
            // Validating Email Field
            $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[1]|max_length[100]|xss_clean');
            // Validating Address Field    
            $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[1]|max_length[500]|xss_clean');
            // Validating Phone Field           
            $this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[1]|max_length[50]|xss_clean');
            // Validating Currency Field   
            $this->form_validation->set_rules('currency', 'Currency', 'trim|required|min_length[1]|max_length[3]|xss_clean');
            // Validating Currency Field   
            $this->form_validation->set_rules('live_appointment_type', 'Live Appointment Type', 'trim|min_length[1]|max_length[100]|xss_clean');
            // Validating Logo Field   
            $this->form_validation->set_rules('logo', 'Logo', 'trim|min_length[1]|max_length[1000]|xss_clean');
            // Validating Department Field   
            $this->form_validation->set_rules('buyer', 'Buyer', 'trim|min_length[5]|max_length[500]|xss_clean');
            // Validating Phone Field           
            $this->form_validation->set_rules('p_code', 'Purchase Code', 'trim|min_length[5]|max_length[50]|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $data = array();
                $data['settings'] = $this->settings_model->getSettings();
                $this->load->view('home/dashboard'); 
                $this->load->view('settings', $data);
                $this->load->view('home/footer'); 
            } else {

                $file_name = $_FILES['img_url']['name'];
                $file_name_pieces = explode('_', $file_name);
                $new_file_name = '';
                $count = 1;
                foreach ($file_name_pieces as $piece) {
                    if ($count !== 1) {
                        $piece = ucfirst($piece);
                    }

                    $new_file_name .= $piece;
                    $count++;
                }
                $config = array(
                    'file_name' => $new_file_name,
                    'upload_path' => "./uploads/",
                    'allowed_types' => "gif|jpg|png|jpeg|pdf",
                    'overwrite' => False,
                    'max_size' => "20480000",
                    'max_height' => "1768",
                    'max_width' => "2024"
                );

                $this->load->library('Upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('img_url')) {
                    $path = $this->upload->data();
                    $img_url = "uploads/" . $path['file_name'];
                    $data = array();
                    $data = array(
                        'system_vendor' => $name,
                        'title' => $title,
                        'address' => $address,
                        'phone' => $phone,
                        'email' => $email,
                        'currency' => $currency,
                        'codec_username' => $buyer,
                        'codec_purchase_code' => $p_code,
                        'logo' => $img_url,
                        'timezone' => $timzone,
                        'footer_message'=>$footer_message,
                        'show_odontogram_in_history'=>$show_odontogram_in_history
                    );
                } else {
                    $data = array();
                    $data = array(
                        'system_vendor' => $name,
                        'title' => $title,
                        'address' => $address,
                        'phone' => $phone,
                        'email' => $email,
                        'currency' => $currency,
                        'codec_username' => $buyer,
                        'codec_purchase_code' => $p_code,
                        'timezone' => $timzone,
                        'footer_message'=>$footer_message,
                        'show_odontogram_in_history'=>$show_odontogram_in_history
                    );
                }
              

                $this->settings_model->updateSettings($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
                $this->timeZone($timzone);
               
                redirect('settings');
            }
        } else {
            $this->session->set_flashdata('feedback', lang('email_required'));
            redirect('settings', 'refresh');
        }
    }

    function backups() {
        $data['files'] = glob('./files/backups/*.zip', GLOB_BRACE);
        $data['dbs'] = glob('./files/backups/*.txt', GLOB_BRACE);
        $data['settings'] = $this->settings_model->getSettings();

        $this->load->view('home/dashboard', $data);
        $this->load->view('backups', $data);
        $this->load->view('home/footer');
    }

    function language() {

        $data['settings'] = $this->settings_model->getSettings();

        $this->load->view('home/dashboard', $data);
        $this->load->view('language', $data);
        $this->load->view('home/footer');
    }

    function changeLanguage() {
        $id = $this->input->post('id');
        $language = $this->input->post('language');
        $language_settings = $this->input->post('language_settings');


        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        $this->form_validation->set_rules('language', 'language', 'trim|required|min_length[1]|max_length[100]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            $data = array();
            $data['settings'] = $this->settings_model->getSettings();
            $this->load->view('home/dashboard', $data); 
            $this->load->view('settings', $data);
            $this->load->view('home/footer'); 
        } else {

            
            $data = array();
            $data = array(
                'language' => $language,
            );

            $this->settings_model->updateSettings($id, $data);

            
            $this->session->set_flashdata('feedback', lang('updated'));
            if (!empty($language_settings)) {
                redirect('settings/language');
            } else {
                redirect('');
            }
        }
    }

    function selectPaymentGateway() {
        $id = $this->input->post('id');
        $payment_gateway = $this->input->post('payment_gateway');


        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
       
        $this->form_validation->set_rules('payment_gateway', 'Payment Gateway', 'trim|required|min_length[1]|max_length[100]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            redirect('pgateway');
        } else {

            
            $data = array();
            $data = array(
                'payment_gateway' => $payment_gateway,
            );

            $this->settings_model->updateSettings($id, $data);

           
            $this->session->set_flashdata('feedback', lang('updated'));
            if (!empty($payment_gateway)) {
                redirect('pgateway');
            } else {
                redirect('');
            }
        }
    }

    function selectSmsGateway() {
        $id = $this->input->post('id');
        $sms_gateway = $this->input->post('sms_gateway');


        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('sms_gateway', 'Sms Gateway', 'trim|required|min_length[1]|max_length[100]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            redirect('pgateway');
        } else {

           
            $data = array();
            $data = array(
                'sms_gateway' => $sms_gateway,
            );

            $this->settings_model->updateSettings($id, $data);

           
            $this->session->set_flashdata('feedback', lang('updated'));
            if (!empty($sms_gateway)) {
                redirect('sms');
            } else {
                redirect('');
            }
        }
    }

    function backup_database() {
        if (!$this->ion_auth->in_group('admin')) {
            $this->session->set_flashdata('error', lang('access_denied'));
            redirect("home/permission");
        }
        $this->load->dbutil();
        $prefs = array(
            'format' => 'sql',
            'filename' => 'hms_db_backup.sql'
        );
        $back = $this->dbutil->backup($prefs);
        $backup = & $back;
        $db_name = 'db-backup-on-' . date("Y-m-d-H-i-s") . '.txt';
        $save = './files/backups/' . $db_name;
        $this->load->helper('file');
        write_file($save, $backup);
        $this->session->set_flashdata('message', 'Database backup Successfull !');
        redirect("settings/backups");

       
    }

    function backup_files() {
        if (!$this->ion_auth->in_group('admin')) {
            $this->session->set_flashdata('error', lang('access_denied'));
            redirect("home/permission");
        }
        $this->load->library('zip');
        $data = array_diff(scandir(FCPATH), array('..', '.', 'files')); 
        foreach ($data as $d) {
            $path = FCPATH . $d;
            if (is_dir($path))
                $this->zip->read_dir($path, false);
            if (is_file($path))
                $this->zip->read_file($path, false);
        }
        $filename = 'file-backup-' . date("Y-m-d-H-i-s") . '.zip';
        $this->zip->archive(FCPATH . 'files/backups/' . $filename);
        $this->session->set_flashdata('message', 'Application backup Successfull !');
        redirect("settings/backups");
        exit();
    }

  

    function restore_database($dbfile) {
        if (!$this->ion_auth->in_group('admin')) {
            $this->session->set_flashdata('error', lang('access_denied'));
            redirect("home/permission");
        }
        $file = file_get_contents('./files/backups/' . $dbfile . '.txt');
        $this->db->conn_id->multi_query($file);
        $this->db->conn_id->close();
        $this->session->set_flashdata('message', 'Restoring of Backup Successfull');
        redirect('settings/backups');
    }

    function download_database($dbfile) {
        if (!$this->ion_auth->in_group('admin')) {
            $this->session->set_flashdata('error', lang('access_denied'));
            redirect("home/permission");
        }
        $this->load->library('zip');
        $this->zip->read_file('./files/backups/' . $dbfile . '.txt');
        $name = 'db_backup_' . date('Y_m_d_H_i_s') . '.zip';
        $this->zip->download($name);
        exit();
    }

    function download_backup($zipfile) {
        if (!$this->ion_auth->in_group('admin')) {
            $this->session->set_flashdata('error', lang('access_denied'));
            redirect("home/permission");
        }
        $this->load->helper('download');
        force_download('./files/backups/' . $zipfile . '.zip', NULL);
        exit();
    }

    function restore_backup($zipfile) {
        if (!$this->ion_auth->in_group('admin')) {
            $this->session->set_flashdata('error', lang('access_denied'));
            redirect("home/permission");
        }
        $file = './files/backups/' . $zipfile . '.zip';
        $this->sma->unzip($file, './');
        $this->session->set_flashdata('info', 'Restoring of Application Successfull');
        redirect("settings/backups");
        exit();
    }

    function delete_database($dbfile) {
        if (!$this->ion_auth->in_group('admin')) {
            $this->session->set_flashdata('error', lang('access_denied'));
            redirect("home/permission");
        }
        unlink('./files/backups/' . $dbfile . '.txt');
        $this->session->set_flashdata('info', 'Deleting of Database Successfull');
        redirect("settings/backups");
    }

    function delete_backup($zipfile) {
        if (!$this->ion_auth->in_group('admin')) {
            $this->session->set_flashdata('error', lang('access_denied'));
            redirect("home/permission");
        }
        unlink('./files/backups/' . $zipfile . '.zip');
        $this->session->set_flashdata('info', 'Deleting of App Backup Successfull');
        redirect("settings/backups");
    }

    function substring($index, $value) {

        foreach ($value as $key => $value2) {

            $value3 = trim(substr($value2, 2));
            $value4[] = substr($value3, 0, -2);
        }

        foreach ($index as $key => $index2) {

            $index3 = substr($index2, 7);
            $index4[] = substr($index3, 0, -3);
        }

        return array_combine($index4, $value4);
    }

    function languageEdit() {
        $id = $this->input->get('id');
       
        $this->load->helper('string');




        if ($id == 'arabic') {
            $path = APPPATH . 'language/arabic/system_syntax_lang.php';
        }
        if ($id == 'english') {
            $path = APPPATH . 'language/english/system_syntax_lang.php';
        }
        if ($id == 'italian') {
            $path = APPPATH . 'language/italian/system_syntax_lang.php';
        }
        if ($id == 'french') {
            $path = APPPATH . 'language/french/system_syntax_lang.php';
        }

        if ($id == 'spanish') {
            $path = APPPATH . 'language/spanish/system_syntax_lang.php';
        }
        if ($id == 'portuguese') {
            $path = APPPATH . 'language/portuguese/system_syntax_lang.php';
        }
        if ($id == 'russian') {
            $path = APPPATH . 'language/russian/system_syntax_lang.php';
        }
        if ($id == 'turkish') {
            $path = APPPATH . 'language/turkish/system_syntax_lang.php';
        } if ($id == 'japanese') {
            $path = APPPATH . 'language/japanese/system_syntax_lang.php';
        }
        if ($id == 'indonesian') {
            $path = APPPATH . 'language/indonesian/system_syntax_lang.php';
        }
        if ($id == 'zh_cn') {
            $path = APPPATH . 'language/zh_cn/system_syntax_lang.php';
        }
        if ($id == 'persian') {
            $path = APPPATH . 'language/persian/system_syntax_lang.php';
        }
        if ($id == 'german') {
            $path = APPPATH . 'language/german/system_syntax_lang.php';
        }
        $file = fopen($path, "r");
        $i = 0;
        while (!feof($file)) {
            $line = fgets($file);

            $arr = explode("=", $line, 2);
            if (!empty($arr[1])) {
                $index[$i] = $arr[0];
                $value[$i] = $arr[1];
                $i = $i + 1;
            }
        }
        fclose($file);



        $data = array();
        $data['languages'] = $this->substring($index, $value);

        $data['languagename'] = $id;



        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard'); 
        $this->load->view('edit_language', $data);
        $this->load->view('home/footer'); 
    }

    function addLanguageTranslation() {
        $id = $this->input->post('language');

        $indexes = $this->input->post('indexupdate');
        $index = explode("#**##***", $indexes);
        $valueupdate = $this->input->post('valueupdate');

        $value = explode("*##**###", $valueupdate);

        foreach ($index as $key => $values) {
            if ($key !== 0) {

                $indexupdate[] = $values;
            }
        }

        foreach ($value as $key => $values) {
            if ($key !== 0) {
                $values = trim($values);
                $value2 = explode("'", $values);
                $length = count($value2);

                if (empty($value2[1])) {
                    //  echo $value
                    $valueupdated[] = $value2[0];
                } else {
                    $valuefinal = array();
                    foreach ($value2 as $keys => $value3) {


                        $lastChar = substr($value3, -1);
                        if (preg_match('/\\\\/', $lastChar)) {
                            $valuefinal[] = $value3 . "'";
                        } else {

                            if ($keys != ($length - 1)) {
                                $valuefinal[] = $value3 . "\'";
                            } else {
                                $valuefinal[] = $value3;
                            }
                        }
                    }
                    $valueconcate = "";
                    foreach ($valuefinal as $valuefinal) {
                        $valueconcate .= $valuefinal;
                    }
                    $valueupdated[] = $valueconcate;
                }
            }
        }



        $data = array();
        $data = array_combine($indexupdate, $valueupdated);

        if ($id == 'arabic') {
            $path = APPPATH . 'language/arabic/system_syntax_lang.php';
        }
        if ($id == 'english') {
            $path = APPPATH . 'language/english/system_syntax_lang.php';
        }
        if ($id == 'italian') {
            $path = APPPATH . 'language/italian/system_syntax_lang.php';
        }
        if ($id == 'french') {
            $path = APPPATH . 'language/french/system_syntax_lang.php';
        }
        if ($id == 'indonesian') {
            $path = APPPATH . 'language/indonesian/system_syntax_lang.php';
        }
        if ($id == 'zh_cn') {
            $path = APPPATH . 'language/zh_cn/system_syntax_lang.php';
        }
        if ($id == 'spanish') {
            $path = APPPATH . 'language/spanish/system_syntax_lang.php';
        }
        if ($id == 'portuguese') {
            $path = APPPATH . 'language/portuguese/system_syntax_lang.php';
        }
        if ($id == 'russian') {
            $path = APPPATH . 'language/russian/system_syntax_lang.php';
        }
        if ($id == 'turkish') {
            $path = APPPATH . 'language/turkish/system_syntax_lang.php';
        } if ($id == 'japanese') {
            $path = APPPATH . 'language/japanese/system_syntax_lang.php';
        }
        if ($id == 'persian') {
            $path = APPPATH . 'language/persian/system_syntax_lang.php';
        }
        if ($id == 'german') {
            $path = APPPATH . 'language/german/system_syntax_lang.php';
        }

        unlink($path);
        $option = "<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Name:  Auth Lang -" . $id . "
 *
 * Author: Ben Edmunds
 * 		  ben.edmunds@gmail.com
 *         @benedmunds
 *
 * Author: Daniel Davis
 *         @ourmaninjapan
 *
 * Location: http://github.com/benedmunds/ion_auth/
 *
 * Created:  03.09.2013
 *
 * Description: " . $id . " language file for Ion Auth example views
 *
 */
// Errors";
        $file_handle = fopen($path, 'a+');
        fwrite($file_handle, $option);
        fwrite($file_handle, "\n");
        foreach ($data as $key => $value) {
            $valueupdate = trim($value);
            $option1 = '$lang' . "['" . $key . "'] = '$valueupdate';";
            fwrite($file_handle, $option1);
            fwrite($file_handle, "\n");
        }


        fclose($file_handle);
        $this->session->set_flashdata('feedback', lang('updated'));
        redirect('settings/language');
    }

    function timeZone($timezone) {

       


        $reading = fopen('index.php', 'r');
        $writing = fopen('index.tmp', 'w');

        $replaced = false;

        while (!feof($reading)) {
            $line = fgets($reading);
           
            if (stristr($line, 'ini_set("date.timezone"')) {
                
                $line = 'ini_set("date.timezone","' . $timezone . '");';
                
                $replaced = true;
            }
            fputs($writing, $line);
              if (stristr($line, 'ini_set("date.timezone"')) {
            fputs($writing, "\n");
              }
        }
      
        fclose($reading);
        fclose($writing);

       
        if ($replaced) {
            rename('index.tmp', 'index.php');
        } else {
            unlink('index.tmp');
        }
    }

    function gmtTime() {
        $timezones = array(
            'Pacific/Midway' => "(GMT-11:00) Midway Island",
            'US/Samoa' => "(GMT-11:00) Samoa",
            'US/Hawaii' => "(GMT-10:00) Hawaii",
            'US/Alaska' => "(GMT-09:00) Alaska",
            'US/Pacific' => "(GMT-08:00) Pacific Time (US &amp; Canada)",
            'America/Tijuana' => "(GMT-08:00) Tijuana",
            'US/Arizona' => "(GMT-07:00) Arizona",
            'US/Mountain' => "(GMT-07:00) Mountain Time (US &amp; Canada)",
            'America/Chihuahua' => "(GMT-07:00) Chihuahua",
            'America/Mazatlan' => "(GMT-07:00) Mazatlan",
            'America/Mexico_City' => "(GMT-06:00) Mexico City",
            'America/Monterrey' => "(GMT-06:00) Monterrey",
            'Canada/Saskatchewan' => "(GMT-06:00) Saskatchewan",
            'US/Central' => "(GMT-06:00) Central Time (US &amp; Canada)",
            'US/Eastern' => "(GMT-05:00) Eastern Time (US &amp; Canada)",
            'US/East-Indiana' => "(GMT-05:00) Indiana (East)",
            'America/Bogota' => "(GMT-05:00) Bogota",
            'America/Lima' => "(GMT-05:00) Lima",
            'America/Caracas' => "(GMT-04:30) Caracas",
            'Canada/Atlantic' => "(GMT-04:00) Atlantic Time (Canada)",
            'America/La_Paz' => "(GMT-04:00) La Paz",
            'America/Santiago' => "(GMT-04:00) Santiago",
            'Canada/Newfoundland' => "(GMT-03:30) Newfoundland",
            'America/Buenos_Aires' => "(GMT-03:00) Buenos Aires",
            'Greenland' => "(GMT-03:00) Greenland",
            'Atlantic/Stanley' => "(GMT-02:00) Stanley",
            'Atlantic/Azores' => "(GMT-01:00) Azores",
            'Atlantic/Cape_Verde' => "(GMT-01:00) Cape Verde Is.",
            'Africa/Casablanca' => "(GMT) Casablanca",
            'Europe/Dublin' => "(GMT) Dublin",
            'Europe/Lisbon' => "(GMT) Lisbon",
            'Europe/London' => "(GMT) London",
            'Africa/Monrovia' => "(GMT) Monrovia",
            'Europe/Amsterdam' => "(GMT+01:00) Amsterdam",
            'Europe/Belgrade' => "(GMT+01:00) Belgrade",
            'Europe/Berlin' => "(GMT+01:00) Berlin",
            'Europe/Bratislava' => "(GMT+01:00) Bratislava",
            'Europe/Brussels' => "(GMT+01:00) Brussels",
            'Europe/Budapest' => "(GMT+01:00) Budapest",
            'Europe/Copenhagen' => "(GMT+01:00) Copenhagen",
            'Europe/Ljubljana' => "(GMT+01:00) Ljubljana",
            'Europe/Madrid' => "(GMT+01:00) Madrid",
            'Europe/Paris' => "(GMT+01:00) Paris",
            'Europe/Prague' => "(GMT+01:00) Prague",
            'Europe/Rome' => "(GMT+01:00) Rome",
            'Europe/Sarajevo' => "(GMT+01:00) Sarajevo",
            'Europe/Skopje' => "(GMT+01:00) Skopje",
            'Europe/Stockholm' => "(GMT+01:00) Stockholm",
            'Europe/Vienna' => "(GMT+01:00) Vienna",
            'Europe/Warsaw' => "(GMT+01:00) Warsaw",
            'Europe/Zagreb' => "(GMT+01:00) Zagreb",
            'Europe/Athens' => "(GMT+02:00) Athens",
            'Europe/Bucharest' => "(GMT+02:00) Bucharest",
            'Africa/Cairo' => "(GMT+02:00) Cairo",
            'Africa/Harare' => "(GMT+02:00) Harare",
            'Europe/Helsinki' => "(GMT+02:00) Helsinki",
            'Europe/Istanbul' => "(GMT+02:00) Istanbul",
            'Asia/Jerusalem' => "(GMT+02:00) Jerusalem",
            'Europe/Kiev' => "(GMT+02:00) Kyiv",
            'Europe/Minsk' => "(GMT+02:00) Minsk",
            'Europe/Riga' => "(GMT+02:00) Riga",
            'Europe/Sofia' => "(GMT+02:00) Sofia",
            'Europe/Tallinn' => "(GMT+02:00) Tallinn",
            'Europe/Vilnius' => "(GMT+02:00) Vilnius",
            'Asia/Baghdad' => "(GMT+03:00) Baghdad",
            'Asia/Kuwait' => "(GMT+03:00) Kuwait",
            'Africa/Nairobi' => "(GMT+03:00) Nairobi",
            'Asia/Riyadh' => "(GMT+03:00) Riyadh",
            'Europe/Moscow' => "(GMT+03:00) Moscow",
            'Asia/Tehran' => "(GMT+03:30) Tehran",
            'Asia/Baku' => "(GMT+04:00) Baku",
            'Europe/Volgograd' => "(GMT+04:00) Volgograd",
            'Asia/Muscat' => "(GMT+04:00) Muscat",
            'Asia/Tbilisi' => "(GMT+04:00) Tbilisi",
            'Asia/Yerevan' => "(GMT+04:00) Yerevan",
            'Asia/Kabul' => "(GMT+04:30) Kabul",
            'Asia/Karachi' => "(GMT+05:00) Karachi",
            'Asia/Tashkent' => "(GMT+05:00) Tashkent",
            'Asia/Kolkata' => "(GMT+05:30) Kolkata",
            'Asia/Kathmandu' => "(GMT+05:45) Kathmandu",
            'Asia/Yekaterinburg' => "(GMT+06:00) Ekaterinburg",
            'Asia/Almaty' => "(GMT+06:00) Almaty",
            'Asia/Dhaka' => "(GMT+06:00) Dhaka",
            'Asia/Novosibirsk' => "(GMT+07:00) Novosibirsk",
            'Asia/Bangkok' => "(GMT+07:00) Bangkok",
            'Asia/Jakarta' => "(GMT+07:00) Jakarta",
            'Asia/Krasnoyarsk' => "(GMT+08:00) Krasnoyarsk",
            'Asia/Chongqing' => "(GMT+08:00) Chongqing",
            'Asia/Hong_Kong' => "(GMT+08:00) Hong Kong",
            'Asia/Kuala_Lumpur' => "(GMT+08:00) Kuala Lumpur",
            'Australia/Perth' => "(GMT+08:00) Perth",
            'Asia/Singapore' => "(GMT+08:00) Singapore",
            'Asia/Taipei' => "(GMT+08:00) Taipei",
            'Asia/Ulaanbaatar' => "(GMT+08:00) Ulaan Bataar",
            'Asia/Urumqi' => "(GMT+08:00) Urumqi",
            'Asia/Irkutsk' => "(GMT+09:00) Irkutsk",
            'Asia/Seoul' => "(GMT+09:00) Seoul",
            'Asia/Tokyo' => "(GMT+09:00) Tokyo",
            'Australia/Adelaide' => "(GMT+09:30) Adelaide",
            'Australia/Darwin' => "(GMT+09:30) Darwin",
            'Asia/Yakutsk' => "(GMT+10:00) Yakutsk",
            'Australia/Brisbane' => "(GMT+10:00) Brisbane",
            'Australia/Canberra' => "(GMT+10:00) Canberra",
            'Pacific/Guam' => "(GMT+10:00) Guam",
            'Australia/Hobart' => "(GMT+10:00) Hobart",
            'Australia/Melbourne' => "(GMT+10:00) Melbourne",
            'Pacific/Port_Moresby' => "(GMT+10:00) Port Moresby",
            'Australia/Sydney' => "(GMT+10:00) Sydney",
            'Asia/Vladivostok' => "(GMT+11:00) Vladivostok",
            'Asia/Magadan' => "(GMT+12:00) Magadan",
            'Pacific/Auckland' => "(GMT+12:00) Auckland",
            'Pacific/Fiji' => "(GMT+12:00) Fiji",
        );
        return $timezones;
    }

    function selectEmailGateway() {
        $id = $this->input->post('id');
        $email_gateway = $this->input->post('email_gateway');


        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('email_gateway', 'Email Gateway', 'trim|required|min_length[1]|max_length[100]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            redirect('email/emailSettings');
        } else {

           
            $data = array();
            $data = array(
                'emailtype' => $email_gateway,
            );

            $this->settings_model->updateSettings($id, $data);

           
            $this->session->set_flashdata('feedback', lang('updated'));
            if (!empty($email_gateway)) {
                redirect('email/emailSettings');
            } else {
                redirect('');
            }
        }
    }

}

/* End of file settings.php */
/* Location: ./application/modules/settings/controllers/settings.php */


