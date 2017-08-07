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

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

     public function upload(Request $request)
    {
        $val_rules=[
            'refprof'=>'required|max:255',
            'nom' => 'required|max:255',
            'prenom'=>'required|max:255',
            'grade'=>'required|max:255',
            'specialite'=>'required|max:255',
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
                $error=false;
                foreach($lignes as $i=>$ligne){
                    $error=false;
                    $l=$i+1; //in case of errors show the ligne where the error is
                    $users_validator=Validator::make($ligne,$val_rules);
                    if($users_validator->fails()){
                        $arr=[
                            "message"=>"ligne $l:\r\n".$users_validator->errors()->first(),
                            "style"=>"text-danger"
                        ];
                        $error=true;
                        return response()->json($arr);
                    }
                }
                if($error==false){//aucune erreur, insertion ds la bdd....
                    foreach($lignes as $i=>$ligne){
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
//                        $prof->confirmation_token=Hash::make(str_random(8));
                        $prof->save();
                    }
                }
                if(!$error){
                    $arr=[
                        "message"=>$l." lignes insérées",
                        "style"=>"text-success"
                    ];
                    return response()->json($arr);
                }
            }
        }else{
            $arr["message"]="Aucun fichier choisi!";
            $arr["class"]="text-danger";
        }
    }
    
    public function download()
    {
        $profs=$this->Users();
        $depts = $this->Departements();
        $excel=Excel::create('Profs')
              ->setTitle('liste des professeurs')
              ->setCreator('prof name')
              ->setCompany('Ensa Tanger')
              ->setDescription('Liste des professeurs inscrits');
        $sheet=$excel->sheet('1',function($sheet)use($profs){
            $sheet
                ->setAllBorders('none')
                ->appendRow(array(
                'id', 'ref prof', 'nom', 'prénom', 'grade', 'spécialité', 'email', 'adresse', 'ville', 'num', 'intitulé département')
                );
            $sheet
                ->cells('A1:k1',function($cell){
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
            //Helvetica Neue",Helvetica,Arial,sans-serif
            $i=2;
            foreach($profs as $prof){
                $dept=$prof->departement["intitule"];
                $data=$prof->toArray();
                $dataExcel=array(
                    "id"=>$data["id"],
                    "refprof"=>$data["refprof"],
                    "name"=>$data["name"],
                    "prenom"=>$data["prenom"],
                    "grade"=>$data["grade"],
                    "specialite"=>$data["specialite"],
                    "email"=>$data["email"],
                    "adress"=>$data["adress"],
                    "ville"=>$data["ville"],
                    "num"=>$data["num"],
                    "id_dept"=>$dept,
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
        $profs=$this->Users();
        $depts = $this->Departements();
        $prof_list=view("users.p_list")->with("cases",$request)
                    ->with('profs',$profs)
                    ->with('depts',$depts)
                    ->render();
        return PDF::loadHtml($prof_list)
                    ->setPaper('A4','landscape')
//                    ->filename("Profs")
                    ->download("Profs.pdf");
    }
}
