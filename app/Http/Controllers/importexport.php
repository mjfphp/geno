<?php

namespace App\Http\Controllers;

use App\Notifications\ActiverCompte;
use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Departement;
use Validator;
use \Storage;
use Maatwebsite\Excel\Writers\CellWriter;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class importexport extends Controller
{

    public function Users()
    {
        $profs=User::all();
        return $profs;
    }
    
    public function Departements(){
        $depts = Departement::all();
        return $depts;
    }

     public function upload(Request $request)
    {
        $val_rules=[
            'refprof'=>'required|max:255',
            'nom' => 'required|max:255|alpha',
            'prenom'=>'required|max:255|alpha',
            'grade'=>'required|max:255|alpha',
            'specialite'=>'required|max:255|alpha',
            'iddept'=>'required|max:255',
            'email' => 'required|unique:users|email',
            'adress'=>'max:255|nullable',
            'ville'=>'max:30|nullable',
            'tel'=>'nullable'
        ];

        $arr= [
            "message"=>null,
            "class"=>null
        ];

        $file_messages=[
            'required'=>"Aucun fichier en chargement!",
            'mimes'=>'Le fichier doit être de format: :values!',
            'uploaded'=>"Le fichier n'a pas pu être chargé!",
            'size'=>'La taille du fichier dépasse 10Mb'
        ];
    
        $file_rules=array(
            'file' =>'required|file|max:10000|mimes:xls,xlsx'
        );
        $file = $request->file('file');
        $file_validator = Validator::make($request->all(),$file_rules,$file_messages);
            if ($file_validator->fails()) {
                $arr=[
                    "message"=>$file_validator->errors()->first('file'),
                    "style"=>"text-danger"
                ];
                return response()->json($arr);
            }
        if($request->hasFile("file")){
            $file = $request->file('file');
            $path=$file->getRealPath();
            $name=$file->getClientOriginalName();
            $destination="upload/".$name;
            $upload=Storage::put($destination,file_get_contents($path));
            if($upload){
                $reader=Excel::load($path);
                $results = $reader->get();
                $lignes=$reader->toArray();
                foreach($lignes as $i=>$ligne){
                    $l=$i+1; //in case of errors show the ligne where the error is
                    $users_validator=Validator::make($ligne,$val_rules);
                    if($users_validator->fails()){
                        $arr=[
                            "message"=>"ligne $l:\r\n".$users_validator->errors()->first(),
                            "style"=>"text-danger"
                        ];
                        return response()->json($arr);
                    }
                        $prof = new User;
                        $prof->name   = $ligne["nom"];
                        $prof->email  = $ligne["email"];
                        $prof->refprof =$ligne["refprof"];
                        $prof->adress = $ligne["adresse"];
                        $prof->ville = $ligne["ville"];
                        $prof->specialite = $ligne["specialite"];
                        $prof->departement_id=$ligne["iddept"];
                        $prof->num = $ligne["tel"];
                        $prof->grade =$ligne["grade"];
                        $prof->prenom= $ligne["prenom"];
                        $prof->password=Hash::make('123456');
                        $prof->save();

                }
            }
        }else{
            $arr["message"]="Aucun fichier choisi!";
            $arr["class"]="text-danger";
        }
    }
    
    public function download(Request $request)
    {
        $profs=$this->Users();
        $depts = $this->Departements();
        $excel=Excel::create('Profs')
              ->setTitle('liste des professeurs')
              ->setCreator('prof name')
              ->setCompany('Ensa Tanger')
              ->setDescription('Liste des professeurs inscrits');
        $sheet=$excel->sheet('1',function($sheet)use($profs,$request){
            $default=array('nom','prenom','email');
            if($request->ERef=='on'){
                $default[]='REFERENCE';
            }
            if($request->EGrade=='on'){
                $default[]='GRADE';
            }
            if($request->ESpe=='on'){
                $default[]='SPECIALITE';
            }
            if($request->EAddr=='on'){
                $default[]='ADDRESSE';
            }
            if($request->ETel=='on'){
                $default[]='TELEPHONE';
            }
            if($request->EVille=='on'){
                $default[]='VILLE';
            }
            if($request->EDep=='on'){
                $default[]='DEPARTEMENT';
            }
            
            $sheet
                ->setAllBorders('none')
                ->appendRow($default)
                ->cells('A1:j1',function($cell){
                        $cell
                            ->setFontWeight('bold')
                            ->setAlignment('center')
                            ->setValignment('center')
                            ->setValignment('center')
                            ->setFontSize(13);
                    })
                ->setHeight(1,30);
            $i=2;
            foreach($profs as $prof){
                $dept=$prof->departement;
                $data=$prof->toArray();
                $dataExcel=array(
                    $data["name"],
                    $data["prenom"],
                    $data["email"],);
                
            if($request->ERef=='on'){
                $dataExcel[]=$data["refprof"];
            }
            if($request->EGrade=='on'){
                $dataExcel[]=$data["grade"];
            }
            if($request->ESpe=='on'){
                $dataExcel[]=$data["specialite"];
            }
            if($request->EAddr=='on'){
                $dataExcel[]=$data["adress"];
            }
            if($request->ETel=='on'){
                $dataExcel[]=$data["num"];
            }
            if($request->EVille=='on'){
                $dataExcel[]=$data["ville"];
            }
            if($request->EDep=='on'){
                $dataExcel[]=$dept["intitule"];
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
        $profs=$this->Users();
        $depts = $this->Departements();
        $prof_list=view("exports.export_pdf_sup")
                    ->with("cases",$request)
                    ->with('profs',$profs)
                    ->with('depts',$depts)
                    ->render();
        return PDF::loadHtml($prof_list)
                    ->setPaper('A4','landscape')
                    ->download("Profs.pdf");
    }
}
