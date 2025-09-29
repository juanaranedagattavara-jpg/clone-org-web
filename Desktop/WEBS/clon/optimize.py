#!/usr/bin/env python3
"""
Script de optimización para Sueño Andino
Limpia archivos de caché, optimiza código y verifica errores
"""

import os
import re
import json
import shutil
from pathlib import Path
from datetime import datetime

class ProjectOptimizer:
    def __init__(self):
        self.project_dir = Path('.')
        self.cache_dirs = ['.cache', 'cache', 'temp', 'tmp', '.next', 'node_modules']
        self.temp_files = ['*.tmp', '*.temp', '*.log', '*.bak', '*.swp', '*.swo']
        self.optimization_log = []
    
    def log(self, message):
        """Registra mensajes de optimización"""
        timestamp = datetime.now().strftime("%H:%M:%S")
        log_message = f"[{timestamp}] {message}"
        print(log_message)
        self.optimization_log.append(log_message)
    
    def clean_cache_files(self):
        """Elimina archivos de caché y temporales"""
        self.log("Limpiando archivos de cache...")
        
        cleaned_count = 0
        
        # Eliminar directorios de caché
        for cache_dir in self.cache_dirs:
            cache_path = self.project_dir / cache_dir
            if cache_path.exists():
                try:
                    shutil.rmtree(cache_path)
                    self.log(f"   [OK] Eliminado: {cache_dir}/")
                    cleaned_count += 1
                except Exception as e:
                    self.log(f"   [ERROR] Error eliminando {cache_dir}: {e}")
        
        # Eliminar archivos temporales
        for pattern in self.temp_files:
            for file_path in self.project_dir.glob(pattern):
                try:
                    file_path.unlink()
                    self.log(f"   ✅ Eliminado: {file_path.name}")
                    cleaned_count += 1
                except Exception as e:
                    self.log(f"   ❌ Error eliminando {file_path.name}: {e}")
        
        self.log(f"📊 Total de archivos/directorios eliminados: {cleaned_count}")
        return cleaned_count
    
    def optimize_html_files(self):
        """Optimiza archivos HTML"""
        self.log("🔧 Optimizando archivos HTML...")
        
        html_files = list(self.project_dir.glob('*.html'))
        optimized_count = 0
        
        for html_file in html_files:
            try:
                with open(html_file, 'r', encoding='utf-8') as f:
                    content = f.read()
                
                original_size = len(content)
                
                # Eliminar espacios en blanco excesivos
                content = re.sub(r'\n\s*\n\s*\n', '\n\n', content)
                content = re.sub(r'[ \t]+', ' ', content)
                
                # Eliminar comentarios HTML innecesarios
                content = re.sub(r'<!--\s*TODO.*?-->', '', content, flags=re.DOTALL)
                content = re.sub(r'<!--\s*FIXME.*?-->', '', content, flags=re.DOTALL)
                
                # Optimizar espacios en atributos
                content = re.sub(r'\s+=\s+', '=', content)
                content = re.sub(r'\s+>', '>', content)
                
                optimized_size = len(content)
                
                if optimized_size < original_size:
                    with open(html_file, 'w', encoding='utf-8') as f:
                        f.write(content)
                    
                    saved_bytes = original_size - optimized_size
                    self.log(f"   ✅ {html_file.name}: -{saved_bytes} bytes")
                    optimized_count += 1
                else:
                    self.log(f"   ℹ️  {html_file.name}: Sin optimizaciones necesarias")
                    
            except Exception as e:
                self.log(f"   ❌ Error optimizando {html_file.name}: {e}")
        
        self.log(f"📊 Archivos HTML optimizados: {optimized_count}")
        return optimized_count
    
    def verify_project_structure(self):
        """Verifica la estructura del proyecto"""
        self.log("🔍 Verificando estructura del proyecto...")
        
        required_files = [
            'sueño-andino-clone.html',
            'sueño-andino-wordpress.html',
            'blog-sueño-andino.html',
            'README.md',
            'package.json',
            '.gitignore'
        ]
        
        missing_files = []
        for file_name in required_files:
            file_path = self.project_dir / file_name
            if not file_path.exists():
                missing_files.append(file_name)
            else:
                self.log(f"   ✅ {file_name}")
        
        if missing_files:
            self.log(f"   ⚠️  Archivos faltantes: {', '.join(missing_files)}")
        else:
            self.log("   ✅ Todos los archivos requeridos están presentes")
        
        return len(missing_files) == 0
    
    def check_file_sizes(self):
        """Verifica tamaños de archivos"""
        self.log("📏 Verificando tamaños de archivos...")
        
        large_files = []
        total_size = 0
        
        for file_path in self.project_dir.rglob('*'):
            if file_path.is_file():
                size = file_path.stat().st_size
                total_size += size
                
                # Archivos mayores a 100KB
                if size > 100 * 1024:
                    large_files.append((file_path.name, size))
                    self.log(f"   ⚠️  {file_path.name}: {size // 1024}KB")
                else:
                    self.log(f"   ✅ {file_path.name}: {size // 1024}KB")
        
        self.log(f"📊 Tamaño total del proyecto: {total_size // 1024}KB")
        
        if large_files:
            self.log(f"⚠️  Archivos grandes encontrados: {len(large_files)}")
        else:
            self.log("✅ Todos los archivos tienen un tamaño apropiado")
        
        return large_files
    
    def generate_report(self):
        """Genera reporte de optimización"""
        self.log("📋 Generando reporte de optimización...")
        
        report = {
            "timestamp": datetime.now().isoformat(),
            "optimization_log": self.optimization_log,
            "project_size": sum(f.stat().st_size for f in self.project_dir.rglob('*') if f.is_file()),
            "file_count": len(list(self.project_dir.rglob('*'))),
            "html_files": len(list(self.project_dir.glob('*.html'))),
            "config_files": len(list(self.project_dir.glob('*.json')))
        }
        
        with open('optimization-report.json', 'w', encoding='utf-8') as f:
            json.dump(report, f, indent=2, ensure_ascii=False)
        
        self.log("✅ Reporte guardado en: optimization-report.json")
        return report
    
    def run_optimization(self):
        """Ejecuta todas las optimizaciones"""
        self.log("🚀 Iniciando optimización del proyecto Sueño Andino")
        self.log("=" * 60)
        
        # Limpiar archivos de caché
        cache_cleaned = self.clean_cache_files()
        
        # Optimizar archivos HTML
        html_optimized = self.optimize_html_files()
        
        # Verificar estructura
        structure_ok = self.verify_project_structure()
        
        # Verificar tamaños
        large_files = self.check_file_sizes()
        
        # Generar reporte
        report = self.generate_report()
        
        # Resumen final
        self.log("=" * 60)
        self.log("🎉 Optimización completada!")
        self.log(f"📊 Resumen:")
        self.log(f"   • Archivos de caché eliminados: {cache_cleaned}")
        self.log(f"   • Archivos HTML optimizados: {html_optimized}")
        self.log(f"   • Estructura del proyecto: {'✅ OK' if structure_ok else '❌ Problemas'}")
        self.log(f"   • Archivos grandes: {len(large_files)}")
        self.log(f"   • Tamaño total: {report['project_size'] // 1024}KB")
        self.log("=" * 60)

def main():
    """Función principal"""
    print("Sueño Andino - Optimizador de Proyecto")
    print("=" * 50)
    
    optimizer = ProjectOptimizer()
    optimizer.run_optimization()

if __name__ == "__main__":
    main()
