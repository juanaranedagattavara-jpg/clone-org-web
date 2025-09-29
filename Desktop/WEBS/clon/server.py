#!/usr/bin/env python3
"""
Servidor de desarrollo para Sueño Andino
Servidor HTTP simple para desarrollo local
"""

import http.server
import socketserver
import webbrowser
import os
import sys
from pathlib import Path

# Configuración del servidor
PORT = 8000
HOST = 'localhost'

class CustomHTTPRequestHandler(http.server.SimpleHTTPRequestHandler):
    """Manejador personalizado para servir archivos estáticos"""
    
    def __init__(self, *args, **kwargs):
        super().__init__(*args, directory=os.getcwd(), **kwargs)
    
    def end_headers(self):
        # Agregar headers de seguridad y caché
        self.send_header('X-Content-Type-Options', 'nosniff')
        self.send_header('X-Frame-Options', 'DENY')
        self.send_header('X-XSS-Protection', '1; mode=block')
        self.send_header('Cache-Control', 'no-cache, no-store, must-revalidate')
        self.send_header('Pragma', 'no-cache')
        self.send_header('Expires', '0')
        super().end_headers()
    
    def log_message(self, format, *args):
        """Log personalizado para el servidor"""
        print(f"[{self.log_date_time_string()}] {format % args}")

def start_server():
    """Inicia el servidor de desarrollo"""
    try:
        with socketserver.TCPServer((HOST, PORT), CustomHTTPRequestHandler) as httpd:
            print(f"🚀 Servidor de desarrollo iniciado en http://{HOST}:{PORT}")
            print(f"📁 Directorio: {os.getcwd()}")
            print(f"🌐 Página principal: http://{HOST}:{PORT}/sueño-andino-clone.html")
            print("⏹️  Presiona Ctrl+C para detener el servidor")
            print("-" * 50)
            
            # Abrir navegador automáticamente
            try:
                webbrowser.open(f'http://{HOST}:{PORT}/sueño-andino-clone.html')
            except:
                pass
            
            httpd.serve_forever()
            
    except KeyboardInterrupt:
        print("\n🛑 Servidor detenido por el usuario")
        sys.exit(0)
    except OSError as e:
        if e.errno == 48:  # Puerto en uso
            print(f"❌ Error: El puerto {PORT} ya está en uso")
            print("💡 Intenta con otro puerto o detén el proceso que lo está usando")
        else:
            print(f"❌ Error al iniciar el servidor: {e}")
        sys.exit(1)

def check_files():
    """Verifica que los archivos principales existan"""
    required_files = [
        'sueño-andino-clone.html',
        'sueño-andino-wordpress.html',
        'blog-sueño-andino.html'
    ]
    
    missing_files = []
    for file in required_files:
        if not os.path.exists(file):
            missing_files.append(file)
    
    if missing_files:
        print("⚠️  Archivos faltantes:")
        for file in missing_files:
            print(f"   - {file}")
        print()
    
    return len(missing_files) == 0

if __name__ == "__main__":
    print("🌄 Sueño Andino - Servidor de Desarrollo")
    print("=" * 50)
    
    # Verificar archivos
    if not check_files():
        print("⚠️  Algunos archivos principales no se encontraron")
        print("   El servidor se iniciará de todas formas...")
        print()
    
    # Iniciar servidor
    start_server()
