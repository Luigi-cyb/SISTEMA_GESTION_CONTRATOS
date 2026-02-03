<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrabajadorController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\AdendaController;
use App\Http\Controllers\ListaNegraController;
use App\Http\Controllers\AlertaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\CumpleañosController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlantillaController;
use App\Http\Controllers\AuditoriaController;
use App\Http\Controllers\UsuarioController;

// ========== RUTAS PÚBLICAS ==========

Route::get('/', function () {
    return view('welcome');
});

// ========== RUTAS AUTENTICADAS ==========

Route::middleware('auth')->group(function () {
    
    // ========== DASHBOARD ==========
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/api/dashboard/estadisticas', [DashboardController::class, 'estadisticas'])->name('api.dashboard.estadisticas');

    // ========== TRABAJADORES CRUD ==========
    Route::resource('trabajadores', TrabajadorController::class, [
        'parameters' => ['trabajadores' => 'trabajador:dni']
    ]);

    // ========== RUTAS PARA DESCARGAR Y ELIMINAR CV ==========
Route::get('trabajadores/{trabajador}/descargar-cv', [TrabajadorController::class, 'descargarCV'])
    ->name('trabajadores.descargar-cv')
    ->middleware('permission:view.trabajadores');

Route::delete('trabajadores/{trabajador}/eliminar-cv', [TrabajadorController::class, 'eliminarCV'])
    ->name('trabajadores.eliminar-cv')
    ->middleware('permission:edit.trabajadores');


    // ========== CONTRATOS CRUD ==========
    Route::resource('contratos', ContratoController::class);
    Route::get('contratos/{contrato}/pdf', [ContratoController::class, 'generarPDF'])->name('contratos.pdf');
    Route::post('contratos/{contrato}/renovar', [ContratoController::class, 'renovar'])->name('contratos.renovar');
Route::get('contratos/{contrato}/descargar-firmado', [ContratoController::class, 'descargarContratoFirmado'])->name('contratos.descargar-firmado');

Route::post('contratos/{contrato}/subir-firmado', [ContratoController::class, 'subirContratoFirmado'])->name('contratos.subir-firmado');

    // Rutas de PDF - NUEVAS
    Route::post('/contratos/{contrato}/generar-pdf', [ContratoController::class, 'generarPDF'])->name('contratos.generar-pdf');
    Route::get('/contratos/descargar-pdf/{ruta}', [ContratoController::class, 'descargarPDF'])->name('contratos.descargar-pdf')->where('ruta', '.*');
    Route::get('/contratos/{contrato}/previsualizar', [ContratoController::class, 'previsualizarPDF'])->name('contratos.previsualizar');
    Route::post('/contratos/{contrato}/regenerar-pdf', [ContratoController::class, 'regenerarPDF'])->name('contratos.regenerar-pdf');
    Route::get('/contratos/plantillas/listar', [ContratoController::class, 'listarPlantillas'])->name('contratos.listar-plantillas');
    Route::put('/contratos/{contrato}/actualizar-y-pdf', [ContratoController::class, 'actualizarYGenerarPDF'])->name('contratos.actualizar-y-pdf');


    // ========== ADENDAS CRUD ==========
    Route::resource('adendas', AdendaController::class);
Route::post('adendas/{adenda}/decision-estabilidad', [AdendaController::class, 'decisionEstabilidad'])->name('adendas.decision-estabilidad');
Route::get('adendas/{adenda}/pdf', [AdendaController::class, 'generarPDF'])->name('adendas.pdf');
Route::post('adendas/{adenda}/subir-firmada', [AdendaController::class, 'subirAdendaFirmada'])->name('adendas.subir-firmada');   
Route::get('adendas/{adenda}/descargar-firmada', [AdendaController::class, 'descargarAdendaFirmada'])->name('adendas.descargar-firmada');

// ========== LISTA NEGRA CRUD ==========
    Route::prefix('lista-negra')->name('lista-negra.')->group(function () {
        Route::get('/', [ListaNegraController::class, 'index'])
            ->name('index')
            ->middleware('permission:view.lista_negra');
        
        Route::get('/create', [ListaNegraController::class, 'create'])
            ->name('create')
            ->middleware('permission:create.lista_negra');
        
        Route::post('/', [ListaNegraController::class, 'store'])
            ->name('store')
            ->middleware('permission:create.lista_negra');
        
        Route::get('/{id}', [ListaNegraController::class, 'show'])
            ->name('show')
            ->middleware('permission:view.lista_negra');
        
        Route::get('/{id}/desbloquear', [ListaNegraController::class, 'desbloquearForm'])
            ->name('desbloquear-form')
            ->middleware('permission:desbloquear.lista_negra');
        
        Route::post('/{id}/desbloquear', [ListaNegraController::class, 'desbloquear'])
    ->name('desbloquear')
    ->middleware('permission:desbloquear.lista_negra');
        
        Route::delete('/{id}', [ListaNegraController::class, 'destroy'])
            ->name('destroy')
            ->middleware('permission:delete.lista_negra');
    });

    // ========== ALERTAS Y NOTIFICACIONES ==========
    Route::prefix('alertas')->name('alertas.')->group(function () {
        Route::get('/', [AlertaController::class, 'index'])
            ->name('index')
            ->middleware('permission:view.alertas');
        
        Route::get('/{id}', [AlertaController::class, 'show'])
            ->name('show')
            ->middleware('permission:view.alertas');
        
        Route::post('/{id}/resolver', [AlertaController::class, 'resolver'])
            ->name('resolver')
            ->middleware('permission:edit.alertas');
        
        Route::post('/generar', [AlertaController::class, 'generar'])
            ->name('generar')
            ->middleware('permission:edit.alertas');
        
        Route::delete('/{id}', [AlertaController::class, 'destroy'])
            ->name('destroy')
            ->middleware('permission:delete.alertas');
    });

    // ========== API ALERTAS (para dashboard) ==========
    Route::get('/api/alertas/dashboard', [AlertaController::class, 'dashboardAlertas'])
        ->name('api.alertas.dashboard');

    // ========== REPORTES ==========
    Route::prefix('reportes')->name('reportes.')->middleware('permission:view.reportes')->group(function () {
        Route::get('/', [ReporteController::class, 'index'])->name('index');
        
        Route::get('/contratos-activos', [ReporteController::class, 'contratosActivos'])->name('contratos-activos');
        
        Route::get('/proximos-vencer', [ReporteController::class, 'proximosVencer'])->name('proximos-vencer');
        
        Route::get('/por-departamento', [ReporteController::class, 'porDepartamento'])->name('por-departamento');
        
        Route::get('/tiempo-acumulado', [ReporteController::class, 'tiempoAcumulado'])->name('tiempo-acumulado');
        
        Route::get('/proximos-estables', [ReporteController::class, 'proximosEstables'])->name('proximos-estables');
        
        Route::get('/exportar-excel', [ReporteController::class, 'exportarExcel'])->name('exportar-excel');
        
        Route::get('/exportar-pdf', [ReporteController::class, 'exportarPDF'])->name('exportar-pdf');
    });

    // ========== CUMPLEAÑOS ==========
    Route::prefix('cumpleaños')->name('cumpleaños.')->group(function () {
        Route::get('/', [CumpleañosController::class, 'index'])
            ->name('index')
            ->middleware('permission:view.cumpleaños');
        
        Route::get('/sincronizar', [CumpleañosController::class, 'sincronizar'])
            ->name('sincronizar')
            ->middleware('permission:create.cumpleaños');
        
        Route::get('/{id}', [CumpleañosController::class, 'show'])
            ->name('show')
            ->middleware('permission:view.cumpleaños');
        
        Route::get('/{id}/registrar-giftcard', [CumpleañosController::class, 'registrarGiftcardForm'])
            ->name('registrar-giftcard-form')
            ->middleware('permission:registrar.giftcard');
        
        Route::post('/{id}/registrar-giftcard', [CumpleañosController::class, 'registrarGiftcard'])
            ->name('registrar-giftcard')
            ->middleware('permission:registrar.giftcard');
        
        Route::put('/{id}/cancelar-giftcard', [CumpleañosController::class, 'cancelarGiftcard'])
            ->name('cancelar-giftcard')
            ->middleware('permission:edit.cumpleaños');
    });

    // ========== API CUMPLEAÑOS (para dashboard) ==========
    Route::get('/api/cumpleaños/proximos', [CumpleañosController::class, 'proximosCumpleaños'])
        ->name('api.cumpleaños.proximos');

        Route::get('/api/cumpleaños/buscar-por-dni/{dni}', [CumpleañosController::class, 'buscarPorDni'])
    ->name('api.cumpleaños.buscar-dni');

        // ========== PLANTILLAS ==========
Route::prefix('plantillas')->name('plantillas.')->middleware('permission:view.plantillas')->group(function () {
    Route::get('/', [PlantillaController::class, 'index'])->name('index');
    Route::get('/create', [PlantillaController::class, 'create'])->name('create')->middleware('permission:create.plantillas');
    Route::post('/', [PlantillaController::class, 'store'])->name('store')->middleware('permission:create.plantillas');
    Route::get('/{plantilla}', [PlantillaController::class, 'show'])->name('show');
    Route::get('/{plantilla}/preview', [PlantillaController::class, 'preview'])->name('preview');
    Route::get('/{plantilla}/pdf', [PlantillaController::class, 'generarPDF'])->name('pdf');  // ← NUEVA
    Route::get('/{plantilla}/edit', [PlantillaController::class, 'edit'])->name('edit')->middleware('permission:edit.plantillas');
    Route::put('/{plantilla}', [PlantillaController::class, 'update'])->name('update')->middleware('permission:edit.plantillas');
    Route::delete('/{plantilla}', [PlantillaController::class, 'destroy'])->name('destroy')->middleware('permission:delete.plantillas');
});

// ========== AUDITORÍA ==========
Route::prefix('auditoria')->name('auditoria.')->middleware('permission:view.auditoria')->group(function () {
    Route::get('/', [AuditoriaController::class, 'index'])->name('index');
    Route::get('/{auditoria}', [AuditoriaController::class, 'show'])->name('show');
});

// ========== CONFIGURACIÓN EMPRESA ==========
Route::prefix('configuracion-empresa')->name('configuracion-empresa.')->middleware('permission:edit.configuracion')->group(function () {
    Route::get('/', [App\Http\Controllers\ConfiguracionEmpresaController::class, 'index'])->name('index');
    Route::put('/actualizar', [App\Http\Controllers\ConfiguracionEmpresaController::class, 'update'])->name('update');
});

// ========== USUARIOS ==========
Route::prefix('usuarios')->name('usuarios.')->middleware('permission:view.usuarios')->group(function () {
    Route::get('/', [UsuarioController::class, 'index'])->name('index');
    Route::get('/create', [UsuarioController::class, 'create'])->name('create')->middleware('permission:create.usuarios');
    Route::post('/', [UsuarioController::class, 'store'])->name('store')->middleware('permission:create.usuarios');
    Route::get('/{usuario}', [UsuarioController::class, 'show'])->name('show');
    Route::get('/{usuario}/edit', [UsuarioController::class, 'edit'])->name('edit')->middleware('permission:edit.usuarios');
    Route::put('/{usuario}', [UsuarioController::class, 'update'])->name('update')->middleware('permission:edit.usuarios');
    Route::delete('/{usuario}', [UsuarioController::class, 'destroy'])->name('destroy')->middleware('permission:delete.usuarios');
});


    // ========== PROFILE ==========
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ========== AGREGAR ESTAS LÍNEAS EN web.php DENTRO DE Route::middleware('auth') ==========


// ========== RUTAS DE AUTENTICACIÓN ==========
// Las rutas de autenticación están en auth.php y son importadas automáticamente por Laravel

require __DIR__.'/auth.php';