<?php

namespace App\Http\Controllers;

use App\Notifications\ActiverCompte;
use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Eleve;
use App\Niveau;
use App\Filiere;
use Validator;
use \Storage;
use Maatwebsite\Excel\Writers\CellWriter;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class EEleves extends Controller
{

    public function eleves()
    {
        return Eleve::all();
    }
    
    public function niveaux(){
        return Niveau::all();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    
    public function download()
    {
        $eleves=$this->eleves();
        $niveaux = $this->niveaux();
        $excel=Excel::create('Eleves')
              ->setTitle('liste des élèves')
              ->setCreator('prof name')
              ->setCompany('Ensa Tanger')
              ->setDescription('Liste des élèves inscrits');
        $sheet=$excel->sheet('1',function($sheet)use($eleves,$niveaux){
            $sheet
                ->setAllBorders('none')
                ->appendRow(array(
                'APOGEE', 'CNE', 'CIN','NOM', 'PRENOM', 'DATE NAISSANCE', 'LIEU NAISSANCE', 'EMAIL', 'VILLE', 'NUM', 'GROUPE', 'NIVEAU','FILIERE','STATUT')
                );
            $sheet
                ->cells('A1:N1',function($cell){
                        $cell
                            ->setFontWeight('bold')
                            ->setAlignment('center')
                            ->setValignment('center')
                            ->setBackground('#212121')
                            ->setFontColor("#FFFFFF")
                            ->setValignment('center')
                            ->setFontSize(13);
                    })
                ->setHeight(1,30);
            $i=2;
            foreach($eleves as $eleve){
//                $niveau=$eleves->niveau["abbreviation"];
                $data=$eleve->toArray();
                $niv=Niveau::find($data["niveau_id"]);
                $niveau=$niv->abbreviation;//hard way */

                $dataExcel=array(
                    'APOGEE'=>$data["apoge"],
                    'CNE'=>$data["cne"],
                    'CIN'=>$data["cin"],
                    'NOM'=>$data["nom"],
                    'PRENOM'=>$data["prenom"],
                    'DATE NAISSANCE'=>$data["date_naissance"],
                    'LIEU NAISSANCE'=>$data["lieu_naissance"],
                    'EMAIL'=>$data["email"],
                    'VILLE'=>$data["ville"],
                    'NUM'=>$data["num"],
                    'GROUPE'=>$data["grp"],
                    'NIVEAU'=>$niveau,
//                  'FILIERE'=>$filiere,
//                    'STATUT'=>$data["statut"],
                );
                $sheet
                    ->appendRow($i,$dataExcel)
                    ->setHeight($i,30)
                    ->row($i,function($line)use($i){
                        $color="#FFFFFF";
                        if($i%2==0){
                            $color="#f2e5e5";
                        }
                        $line
                            ->setValignment('center')
                            ->setAlignment('center')
                            ->setBackground($color);
                    });
                $i++;
            }
        });
       $sheet->export("xls");
    }
    
    public function downloadPdf(Request $request)
    {
        $eleves=$this->eleves();
        $niveaux = $this->niveaux();
        $prof_list=  view("exports.export_pdf_eleves")
                    ->with("cases",$request)
                    ->with('eleves',$eleves)
                    ->with('niveaux',$niveaux)
                    ->render()
            ;
        return PDF::loadHtml($prof_list)
                    ->setPaper('A4','landscape')
                    ->download("Eleves.pdf");
    }
}
