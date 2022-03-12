<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use PDF;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::all();
        $roles = Role::all();
        return view("admin.usuario.index", compact("usuarios", "roles"));
    }

    public function actualizarRol(Request $request, $id)
    {
        $user = User::find($id);
        /*foreach($request->roles as $rol){
            $role = Role::where('name', $rol)->first();
            $user->assignRole($role);            
        }*/
        $user->syncRoles($request->roles);
        return redirect()->back()->with("mensaje", "Role Actualizado");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "email" => "required|unique:users",
            "password" => "required",
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $user->assignRole($request->role);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function reporteListaPDF()
    {
        $usuarios = User::all();



        PDF::setFooterCallback(function($pdf){

            PDF::Image('logo.jpg',10,8,50,20);
            PDF::Image('fondo.jpg',160,8,50,20);
			$pdf->SetY(-15);
			$pdf->SetFont('courier', 'I', 7);
		    /* establecemos el color del texto */
          	$pdf->SetTextColor(0,0,0);
            $pdf->SetX(10);
            $pdf->Cell(0, 10, ''.date('d-m-Y H:i:s').'',
                             0, false, 'L', 0, '', 0, false, 'T', 'M');

            $pdf->SetFont('courier', 'I', 10);
            $pdf->Cell(0, 10, 'Pag. '.$pdf->getAliasNumPage().
                             ' de '.
                             $pdf-> getAliasNbPages(),
                             0, false, 'R', 0, '', 0, false, 'T', 'M');

            $pdf->SetFont('courier', 'B', 6);
            $pdf->SetXY(10,262);
            //$pdf->Cell(0, 5, "[0, false, 'R', 0, '', 0, false, 'T', 'M');

            $pdf->SetDrawColor(0,0,255);
            /* dibujamos una linea roja delimitadora del pie de página */
          	$pdf->Line(10,266,205,266);

        });

        PDF::SetFontSubsetting(false);
		PDF::SetFontSize('10px');
		PDF::SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		PDF::AddPage('P', 'LETTER');
		PDF::SetX(10);//inicio posicion del contenido
		PDF::SetY(35);//inicio posicion del contenido

		PDF::SetFont('courier', 'B', 10);
		PDF::Cell(0, 1,'Sistema de Pedidos de Productos',0,1,'C');	
		PDF::Cell(0, 2,'"EMPRESA"',0,1,'C');	
        PDF::SetFont('courier', 'B', 15);
        //PDF::SetTextColor(0,0,255);
        PDF::Cell(0, 15,'LISTA DE USUARIOS ', 0,1,'C');		
        	
        PDF::Line(50,54,165,54);
        PDF::SetDrawColor(0,0,255);	
        PDF::Line(6, 30, 210, 30);
                
        PDF::lastPage();

        PDF::SetX(10);//inicio posicion del contenido
		PDF::SetY(55);//inicio posicion del contenido
		//PDF::writeHTML($html, true, false, true, false, '');
		PDF::SetFont('courier', 'B', 12);
		//PDF::Cell(0, 5,'DATOS PERSONALES',0,1,'L');
        PDF::SetFont('courier', 'B', 10);
        PDF::SetTextColor(0,0,0);
        
		PDF::Cell(0, 10,'Gestion: '. (date('Y')),0,1,'L');

        $html='<table width="100%" border="1" style="padding:3px;">
        <thead>
        <tr>
        <th width="40px"><b>COD.</b></th>
        <th width="130px">NOMBRE</th>
        <th width="150px">EMAIL</th>
        <th width="80px">ROLES</th>
        </tr>
        </thead>
        <tbody>';
        foreach($usuarios as $u){
            
            $ul = '<ul>';
            foreach($u->roles as $rol){
                $ul .= '<li>' . $rol->name .'</li>';                
            }
            $ul.='</ul>';
    
                $html.='<tr>
                <td width="40px">'. $u->id .'</td>
                <td width="130px">'. $u->name. '</td>
                <td width="150px">'. $u->email. '</td>
                <td width="80px">'.$ul.'</td>
                </tr>';            
        }
             
    
        $html.='</tbody></table>';
    
    
        PDF::writeHTML($html, true, false, true, false, '');

        $style = array(
		    'border' => false,//borde 2
		    'vpadding' => 'auto',
		    'hpadding' => 'auto',
		    'fgcolor' => array(0,0,0),
		    'bgcolor' => false, //array(255,255,255)
		    'module_width' => 1, // width of a single module in points
		    'module_height' => 1 // height of a single module in points
		);
		PDF::SetFont('courier', 'B', 10);
		PDF::Ln();
        PDF::write2DBarcode('EMPRESA LISTA DE USUARIO', 'QRCODE,H', 180, 45, 60, 60, $style, 'N');


        PDF::Output('lista_usuarios.pdf');
    }
}
