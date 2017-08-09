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

    public function eleves($niv)
    {
        return Eleve::where('niveau_id','=',$niv)->get();
    }
    
    public function niveaux($niv){
        return Niveau::find($niv)->abbreviation;
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    
    public function download(Request $request)
    {
        if($request->niv==null){
            return false;
        }
        $eleves=$this->eleves($request->niv);
        $niveau = $this->niveaux($request->niv);
        $excel=Excel::create('Eleves')
              ->setTitle('liste des élèves')
              ->setCreator('prof name')
              ->setCompany('Ensa Tanger')
              ->setDescription('Liste des élèves inscrits');
        $sheet=$excel->sheet('1',function($sheet)use($eleves,$request,$niveau){
            $default=array('CNE','NOM','PRENOM');
            if($request->ECIN=='on'){
                $default[]='CIN';
            }
            if($request->EAPOGEE=='on'){
                $default[]='APOGEE';
            }
            if($request->EDate_naissance=='on'){
                $default[]='DATE NAISSANCE';
            }
            if($request->Elieu_naisasnce=='on'){
                $default[]='LIEU NAISSANCE';
            }
            if($request->EEMAIL=='on'){
                $default[]='EMAIL';
            }
            if($request->EVille=='on'){
                $default[]='VILLE';
            }
            if($request->ETel=='on'){
                $default[]='NUM';
            }
            if($request->EGroupe=='on'){
                $default[]='GROUPE';
            }
            if($request->ENiveau=='on'){
                $default[]='NIVEAU';
            }
            if($request->Filiere=='on'){
                $default[]='FILIERE';
            }
            if($request->EStatut=='on'){
                $default[]='STATUT';
            }
            $sheet
                ->setAllBorders('none')
                ->appendRow($default);
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
                $data=$eleve->toArray();
                $dataExcel=array(
                    'CNE'=>$data["cne"],
                    'NOM'=>$data["nom"],
                    'PRENOM'=>$data["prenom"],
                );
            if($request->ECIN=='on'){
                $dataExcel[]=$data["cin"];
            }
            if($request->EAPOGEE=='on'){
                $dataExcel[]=$data["apoge"];
            }
            if($request->EDate_naissance=='on'){
                $dataExcel[]=$data["date_naissance"];
            }
            if($request->Elieu_naisasnce=='on'){
                $dataExcel[]=$data["lieu_naissance"];
            }
            if($request->EEMAIL=='on'){
                $dataExcel[]=$data["email"];
            }
            if($request->EVille=='on'){
                $dataExcel[]=$data["ville"];
            }
            if($request->ETel=='on'){
                $dataExcel[]=$data["num"];
            }
            if($request->EGroupe=='on'){
                $dataExcel[]=$data["grp"];
            }
            if($request->ENiveau=='on'){
                $dataExcel[]=$niveau;
            }
            if($request->Filiere=='on'){
                $dataExcel[]='FILIERE';
            }
            if($request->EStatut=='on'){
                $dataExcel[]='STATUT';
            }
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
        $eleves=$this->eleves($request->niv);
        $niveau = $this->niveaux($request->niv);
        $prof_list=  view("exports.export_pdf_eleves")
                    ->with("cases",$request)
                    ->with('eleves',$eleves)
                    ->with('niveau',$niveau)
                    ->render()
            ;
        return PDF::loadHtml($prof_list)
                    ->setPaper('A4','landscape')
                    ->download("Eleves.pdf");
    }
}
