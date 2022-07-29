<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('home');
    }

    public function get_autocomplete()
	{
		// if (isset($_GET['kunci'])) {
			// $result = $this->M_vod->search_VOD($_GET['jenjang'], $_GET['mapel'], $_GET['kunci'], $_GET['asal']);
			// if (count($result) > 0) {
			// 	foreach ($result as $row)
					$arr_result[] = array(
						"value" => "satu",//$row->judul,
						"deskripsi" => "isi satu"//$row->deskripsi
					);
				echo json_encode($arr_result);
			// }
		// }
	}
}
