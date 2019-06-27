<?php

namespace App\Traits;

trait manipulasiMatriksTopsis
{

    /**
     *===========================================================
     *                     FUNGSI MANIPULASI DATA
     *===========================================================
     * */


     //MATRIKS
     public function normalisedWeighted($normalised,$bobot){
        for($baris = 0; $baris < count($normalised); $baris++)
        {
            for($kolom = 0; $kolom < count($normalised[$baris])-1; $kolom++)//-1, kolom terakhir diabaikan
            {
                $normalised[$baris][$kolom] = $normalised[$baris][$kolom]*$bobot[$kolom];
            }
        }
        return $normalised;
    }


    public function normalise($matriks,$pembagi){
        for($baris = 0; $baris < count($matriks); $baris++)
        {
            for($kolom = 0; $kolom < count($matriks[$baris])-1; $kolom++)//-1, kolom terakhir diabaikan
            {
                $matriks[$baris][$kolom] = $matriks[$baris][$kolom]/$pembagi[$kolom];
            }
        }
        return $matriks;
    }

    public function sumPerColumnsBerpangkatDiakarkanTanpaKolomTerakhir($matriks){
        $sumCol=[];
        for( $kolom = 0; $kolom < count($matriks[0])-1; $kolom++){//-1, kolom terakhir diabaikan
            $sumCol[$kolom]=0;
            for( $baris = 0; $baris < count($matriks); $baris++){
                $matriks[$baris][$kolom]=pow($matriks[$baris][$kolom],2);
                $sumCol[$kolom]=$sumCol[$kolom]+$matriks[$baris][$kolom];
            }
            $sumCol[$kolom]=sqrt($sumCol[$kolom]);
        }
        return $sumCol;//array sumColumnsBerpangkat per Column
    }

    public function sumPerRowsDiakarkanTanpaKolomTerakhir($matriks){
        for( $baris = 0; $baris < count($matriks); $baris++){
            $sumRow[$baris]=0;
            for( $kolom = 0; $kolom < count($matriks[0])-1; $kolom++){
                $sumRow[$baris]=$sumRow[$baris]+$matriks[$baris][$kolom];
            }
            $sumRow[$baris]=sqrt($sumRow[$baris]);
        }
        return $sumRow;//array sumRowsBerpangkat per Row
    }








    public function kriteriaMaxMin($matriksWeightedTopsis){
        for( $kolom = 0; $kolom < count($matriksWeightedTopsis[0])-1; $kolom++){//-1, kolom terakhir diabaikan
            $matriksPerCol=[];
            for( $baris = 0; $baris < count($matriksWeightedTopsis); $baris++){
                $matriksPerCol[]=$matriksWeightedTopsis[$baris][$kolom];
            }
            $maxMin[$kolom]['max']=max($matriksPerCol);
            $maxMin[$kolom]['min']=min($matriksPerCol);
        }
        return $maxMin;//array per Kriteria
    }

    public function matriksSolusiIdeal($maxmin,$jenis){
        for ($i=0; $i < count($maxmin); $i++)
        {
            if ($jenis[$i]=="Benefit") {
                $solusiIdeal[$i]['jenis']=$jenis[$i];
                $solusiIdeal[$i]['positif']=$maxmin[$i]['max'];
                $solusiIdeal[$i]['negatif']=$maxmin[$i]['min'];
            }
            elseif($jenis[$i]=="Cost")
            {
                $solusiIdeal[$i]['jenis']=$jenis[$i];
                $solusiIdeal[$i]['positif']=$maxmin[$i]['min'];
                $solusiIdeal[$i]['negatif']=$maxmin[$i]['max'];
            }
        }
        return $solusiIdeal;//array per Kriteria
    }

    public function distance($weighted,$solusiIdeal,$psOrNg){
        for($baris = 0; $baris < count($weighted); $baris++)
        {
            for($kolom = 0; $kolom < count($weighted[$baris])-1; $kolom++)//-1, kolom terakhir diabaikan
            {
                $weighted[$baris][$kolom] = pow($weighted[$baris][$kolom]-$solusiIdeal[$kolom][$psOrNg],2);
            }
        }

        $hasil=$this->sumPerRowsDiakarkanTanpaKolomTerakhir($weighted);

        return $hasil;//ARRAY per baris
    }

    public function nilaiPreferensi($dPositif,$dNegatif,$matriksUntukAmbilID){
        for($baris = 0; $baris < count($dPositif); $baris++)
        {
            $id=$matriksUntukAmbilID[$baris][count($matriksUntukAmbilID[0])-1];//ambil ID
            $hasil[$id]['nilai']=$dNegatif[$baris]/($dPositif[$baris]+$dNegatif[$baris]);
            // $hasil[$baris]['id']=$matriksUntukAmbilID[$baris][count($matriksUntukAmbilID[0])-1];
        }
        return $hasil;//ARRAY per baris
    }







}