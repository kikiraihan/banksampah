<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \Carbon\Carbon;
use Fpdf;
use App\Models\Nasabah;

class pdfController extends Controller
{
    public function nasabahTrans(Fpdf $pdf){


        $nasabah = Nasabah::Has('transaksiSampahs')->with(['transaksiSampahs','user'])->get();
        // dd($nasabah);

        ob_end_clean();

        // Fpdf::SetMargins(2,1,1);
        // Fpdf::AliasNbPages();

        Fpdf::AddPage();
        //set font to arial, bold, 14pt
        Fpdf::SetFont('Arial','B',14);
        //Cell(width , height , text , border , end line , [align] )
        //dibawah ini title
        Fpdf::Cell(276, 30,'Data Nasabah Aplikasi Bank Sampah',0,1,'C');
        //set font to arial, regular, 12pt
        Fpdf::SetFont('Arial','',10);
        //dibawah ini tanggal di print
        Fpdf::Cell(30,5,'Tanggal di print :',0, 0);
        Fpdf::Cell(0, 5, Carbon::now(), 0, 1);
        //dibawah ini spasi horizontal
        Fpdf::Cell(277 ,7,'',0,1);
        //dibawah ini nama tabel
        Fpdf::Cell(10 ,6,'No.',1,0,'C');
        Fpdf::Cell(85 ,6,'Nama',1,0,'C');
        Fpdf::Cell(70 ,6,'NIK',1,0,'C');
        // Fpdf::Cell(61 ,6,'Alamat',1,0,'C');
        Fpdf::Cell(62 ,6,'Dusun',1,0,'C');
        Fpdf::Cell(50 ,6,'Jumlah transaksi',1,1,'C');
        //membuat cell dummy untuk spasi
        //Fpdf::Cell(189 ,10,'',0,1);//end of line

        //dibawah ini data tabel
        $no=1;
        foreach($nasabah as $n){
            Fpdf::Cell(10 ,6,$no++,1,0,'C');
            Fpdf::Cell(85 ,6,$n->user->name,1,0,'C');
            Fpdf::Cell(70 ,6,$n->ktp,1,0,'C');
            // Fpdf::Cell(61 ,6,$n->alamat,1,0,'C');
            Fpdf::Cell(62 ,6,$n->dusun,1,0,'C');
            Fpdf::Cell(50 ,6,count($n->transaksiSampahs),1,1,'C');
        }
        //output the result
        Fpdf::Output();

    }
}
