@extends('layouts.app')

@section('content')
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header Estratégico Compacto -->
            <div class="animate-fade-in"
                style="background: linear-gradient(135deg, #1e293b 0%, #334155 100%); color: white; border-radius: 16px; padding: 30px; margin-bottom: 30px; box-shadow: 0 15px 20px -5px rgba(30, 41, 59, 0.15); display: flex; align-items: center; gap: 24px; position: relative; overflow: hidden;">
                <div style="position: absolute; top: -20px; right: -20px; width: 120px; height: 120px; background: rgba(255,255,255,0.05); border-radius: 50%; filter: blur(30px);"></div>

                <div class="animate-float"
                    style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(12px); padding: 18px; border-radius: 20px; border: 1px solid rgba(255, 255, 255, 0.1); box-shadow: 0 8px 24px rgba(0,0,0,0.2);">
                    <svg class="w-12 h-12 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>

                <div class="relative z-10">
                    <h1 style="font-size: 32px; font-weight: 800; margin: 0; letter-spacing: -0.025em; line-height: 1.1;">
                        Gestión <span style="background: linear-gradient(to right, #60a5fa, #3b82f6); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Corporativa</span>
                    </h1>
                    <p style="color: #94a3b8; margin: 8px 0 0 0; font-size: 16px; font-weight: 500;">Identidad fiscal y representación legal</p>
                    <div style="display: flex; align-items: center; margin-top: 14px;">
                        <div class="pulse-blue" style="width: 8px; height: 8px; background: #60a5fa; border-radius: 50%; margin-right: 10px;"></div>
                        <p style="color: #64748b; font-size: 13px; margin: 0; font-weight: 600; text-transform: uppercase;">
                            Master Data • {{ $configuracion->updated_at ? $configuracion->updated_at->format('d/m/Y') : 'Emiconsath' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Alertas de Sistema -->
            @if (session('success'))
                <div class="animate-fade-in mb-6" style="background: #ecfdf5; border-left: 4px solid #10b981; padding: 15px; border-radius: 10px; display: flex; align-items: center; gap: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    <p style="color: #065f46; font-size: 14px; font-weight: 700; margin:0;">{{ session('success') }}</p>
                </div>
            @endif

            <!-- Card de Información Actual (Talla Media) -->
            <div class="slide-up mb-8" style="background: white; border-radius: 20px; padding: 24px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); border: 1px solid #f1f5f9; position: relative; overflow: hidden;">
                <div style="position: absolute; top:0; right:0; width: 100px; height: 100%; background: linear-gradient(90deg, transparent, #f8fafc); opacity: 0.5;"></div>

                <h2 style="font-size: 10px; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 0.15em; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                    <div style="width: 16px; height: 2px; background: #3b82f6;"></div>
                    Resumen Ejecutivo Actual
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 relative z-10">
                    <div class="flex items-center gap-4">
                        <div style="background: #eff6ff; color: #3b82f6; padding: 12px; border-radius: 14px;">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <div>
                            <p style="font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase;">Institución</p>
                            <p style="font-size: 16px; font-weight: 800; color: #1e293b;">{{ $configuracion->razon_social }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <div style="background: #f0f9ff; color: #0ea5e9; padding: 12px; border-radius: 14px;">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <p style="font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase;">Titular</p>
                            <p style="font-size: 16px; font-weight: 800; color: #1e293b;">{{ $configuracion->gerenteNombreCompleto() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulario de Edición (Talla Media) -->
            <form action="{{ route('configuracion-empresa.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Datos de la Empresa -->
                    <div class="slide-up" style="animation-delay: 0.1s; background: white; border-radius: 20px; padding: 28px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); border: 1px solid #f1f5f9;">
                        <h3 style="font-size: 16px; font-weight: 800; color: #1e293b; display: flex; align-items: center; gap: 10px; margin-bottom: 24px;">
                            <span style="background: #eff6ff; color: #3b82f6; padding: 6px; border-radius: 8px;">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </span>
                            Datos Fiscales
                        </h3>

                        <div class="space-y-5">
                            <div>
                                <label style="display: block; font-size: 12px; font-weight: 700; color: #64748b; margin-bottom: 8px; text-transform: uppercase;">Razón Social</label>
                                <input type="text" name="razon_social" value="{{ old('razon_social', $configuracion->razon_social) }}" required
                                    style="width: 100%; border: 1px solid #e2e8f0; border-radius: 10px; padding: 10px 14px; font-size: 14px; font-weight: 600; color: #1e293b; outline: none; transition: 0.2s;"
                                    class="focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                            </div>

                            <div>
                                <label style="display: block; font-size: 12px; font-weight: 700; color: #64748b; margin-bottom: 8px; text-transform: uppercase;">RUC (Tax ID)</label>
                                <input type="text" name="ruc" value="{{ old('ruc', $configuracion->ruc) }}" required maxlength="11" pattern="[0-9]{11}"
                                    style="width: 100%; border: 1px solid #e2e8f0; border-radius: 10px; padding: 10px 14px; font-size: 14px; font-weight: 600; color: #1e293b; outline: none;"
                                    class="focus:border-blue-500 focus:ring-4 focus:ring-blue-100 placeholder:text-gray-300" placeholder="20XXXXXXXXX">
                            </div>

                            <div>
                                <label style="display: block; font-size: 12px; font-weight: 700; color: #64748b; margin-bottom: 8px; text-transform: uppercase;">Domicilio Legal</label>
                                <textarea name="direccion" required rows="2"
                                    style="width: 100%; border: 1px solid #e2e8f0; border-radius: 10px; padding: 10px 14px; font-size: 13px; font-weight: 600; color: #1e293b; outline: none; resize: none;"
                                    class="focus:border-blue-500 focus:ring-4 focus:ring-blue-100">{{ old('direccion', $configuracion->direccion) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Representante Legal -->
                    <div class="slide-up" style="animation-delay: 0.2s; background: white; border-radius: 20px; padding: 28px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); border: 1px solid #f1f5f9;">
                        <h3 style="font-size: 16px; font-weight: 800; color: #1e293b; display: flex; align-items: center; gap: 10px; margin-bottom: 24px;">
                            <span style="background: #f0f9ff; color: #0ea5e9; padding: 6px; border-radius: 8px;">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </span>
                            Representación
                        </h3>

                        <div class="space-y-5">
                            <div class="flex gap-4">
                                <div style="width: 80px;">
                                    <label style="display: block; font-size: 12px; font-weight: 700; color: #64748b; margin-bottom: 8px; text-transform: uppercase;">Grado</label>
                                    <input type="text" name="gerente_titulo" value="{{ old('gerente_titulo', $configuracion->gerente_titulo) }}" maxlength="50"
                                        style="width: 100%; border: 1px solid #e2e8f0; border-radius: 10px; padding: 10px 14px; font-size: 14px; font-weight: 600; color: #1e293b; outline: none;"
                                        class="focus:border-blue-500 focus:ring-4 focus:ring-blue-100" placeholder="Ing.">
                                </div>
                                <div class="flex-1">
                                    <label style="display: block; font-size: 12px; font-weight: 700; color: #64748b; margin-bottom: 8px; text-transform: uppercase;">Gerente General</label>
                                    <input type="text" name="gerente_nombre" value="{{ old('gerente_nombre', $configuracion->gerente_nombre) }}" required
                                        style="width: 100%; border: 1px solid #e2e8f0; border-radius: 10px; padding: 10px 14px; font-size: 14px; font-weight: 600; color: #1e293b; outline: none;"
                                        class="focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                                </div>
                            </div>

                            <div>
                                <label style="display: block; font-size: 12px; font-weight: 700; color: #64748b; margin-bottom: 8px; text-transform: uppercase;">Documento (DNI/CE)</label>
                                <input type="text" name="gerente_dni" value="{{ old('gerente_dni', $configuracion->gerente_dni) }}" required maxlength="12"
                                    style="width: 100%; border: 1px solid #e2e8f0; border-radius: 10px; padding: 10px 14px; font-size: 14px; font-weight: 600; color: #1e293b; outline: none;"
                                    class="focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                            </div>

                            <div style="background: #f8fafc; padding: 14px; border-radius: 12px; border: 1px solid #f1f5f9; margin-top: 10px;">
                                <p style="font-size: 11px; font-weight: 700; color: #64748b; margin: 0; display: flex; align-items: center; gap: 6px;">
                                    <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                                    @if($configuracion->updated_at)
                                        Edición: {{ $configuracion->updated_at->format('d/m/Y H:i') }}
                                    @else
                                        Estado: Inicial
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botones Medianos -->
                <div class="slide-up mt-8 flex flex-col sm:flex-row gap-4">
                    <button type="submit" 
                        style="flex: 1; background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%); color: white; padding: 16px; border-radius: 14px; font-size: 16px; font-weight: 800; border: none; cursor: pointer; transition: 0.3s; box-shadow: 0 8px 15px rgba(59, 130, 246, 0.2);"
                        onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 12px 20px rgba(59, 130, 246, 0.3)'"
                        onmouseout="this.style.transform='translateY(0)';">
                        💾 Guardar Cambios
                    </button>

                    <a href="{{ route('dashboard') }}" 
                        style="flex: 1; background: white; color: #64748b; padding: 16px; border-radius: 14px; font-size: 15px; font-weight: 700; border: 1px solid #e2e8f0; text-decoration: none; text-align: center; transition: 0.2s;"
                        onmouseover="this.style.background='#f8fafc'; this.style.color='#1e293b';"
                        onmouseout="this.style.background='white';">
                        Cancelar
                    </a>
                </div>
            </form>

            <!-- Directiva Talla Media -->
            <div class="slide-up mt-8" style="animation-delay: 0.4s; background: #fffbeb; border-radius: 16px; padding: 20px; border: 1px solid #fef3c7;">
                <div style="display: flex; gap: 14px; align-items: center;">
                    <div style="background: #f59e0b; color: white; padding: 8px; border-radius: 10px;">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <p style="font-size: 13px; font-weight: 600; color: #b45309; line-height: 1.5; margin: 0;">
                        <strong>Nota:</strong> Los cambios afectan solo a los <strong>nuevos documentos</strong>. Los registros históricos se preservan por integridad legal.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes fadeIn { from { opacity: 0; transform: translateY(15px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes slideUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes floating { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }

        .animate-fade-in { animation: fadeIn 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        .animate-float { animation: floating 4s ease-in-out infinite; }
        .slide-up { animation: slideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; }
        .pulse-blue { animation: pulseBlue 2s infinite; }
        @keyframes pulseBlue { 0% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.4); } 70% { box-shadow: 0 0 0 8px rgba(59, 130, 246, 0); } 100% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0); } }
    </style>
@endsection