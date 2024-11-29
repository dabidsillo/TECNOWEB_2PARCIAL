<?php

namespace App\Http\Controllers;

use App\Models\Pagina;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Config;

class ConfiguracionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $this->establecerTema();

        Pagina::contarPagina(\request()->path());
        return view('configuraciones.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if ($request->modo_oscuro == 'on') {
            session(['modo' => 'dark']);
        } else {
            session(['modo' => 'light']);
        }
       
        switch ($request->tema) {
            case 'adulto':
                session(['tema' => 'adulto']);
                break;
            case 'joven':
                session(['tema' => 'joven']);
                break;
            case 'nino':
                session(['tema' => 'nino']);
                break;
        }

        return redirect()->route('configuraciones.index')->with('success', 'Configuración guardada correctamente');
    }


    public static function establecerTema()
    {
        $tema = $tema = session('tema', 'adulto');
        $modo = session('modo', 'light');

        switch ($tema) {
            case 'adulto':
                if ($modo == 'light') {
                    Config::set('adminlte.classes_sidebar', 'sidebar-light-blue elevation-4');
                    Config::set('adminlte.layout_dark_mode', null);
                    Config::set('adminlte.classes_topnav', 'navbar-white navbar-light');
                } else {
                    Config::set('adminlte.classes_sidebar', 'sidebar-dark-blue elevation-4');
                    Config::set('adminlte.layout_dark_mode', true);
                    Config::set('adminlte.classes_topnav', 'navbar-dark navbar-dark');
                }
                break;
            case 'joven':
                if ($modo == 'light') {
                    Config::set('adminlte.classes_sidebar', 'sidebar-light-danger elevation-4');
                    Config::set('adminlte.layout_dark_mode', null);
                    Config::set('adminlte.classes_topnav', 'navbar-white navbar-light');
                } else {
                    Config::set('adminlte.classes_sidebar', 'sidebar-dark-danger elevation-4');
                    Config::set('adminlte.layout_dark_mode', true);
                    Config::set('adminlte.classes_topnav', 'navbar-dark navbar-dark');
                }
                break;
            case 'nino':
                if ($modo == 'light') {
                    Config::set('adminlte.classes_sidebar', 'sidebar-light-success border border-success elevation-4');
                    Config::set('adminlte.layout_dark_mode', null);
                    Config::set('adminlte.classes_topnav', 'navbar-white navbar-light');
                } else {
                    Config::set('adminlte.classes_sidebar', 'sidebar-dark-success border border-success elevation-4');
                    Config::set('adminlte.layout_dark_mode', true);
                    Config::set('adminlte.classes_topnav', 'navbar-dark navbar-dark');
                }
                break;
        }

    }

}
