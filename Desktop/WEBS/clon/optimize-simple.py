#!/usr/bin/env python3
"""
Script simple de optimización para Sueño Andino
"""

import os
import shutil
from pathlib import Path

def clean_cache():
    """Limpia archivos de caché"""
    print("Limpiando archivos de cache...")
    
    cache_dirs = ['.cache', 'cache', 'temp', 'tmp', '.next', 'node_modules']
    cleaned = 0
    
    for cache_dir in cache_dirs:
        if os.path.exists(cache_dir):
            try:
                shutil.rmtree(cache_dir)
                print(f"  [OK] Eliminado: {cache_dir}/")
                cleaned += 1
            except Exception as e:
                print(f"  [ERROR] Error con {cache_dir}: {e}")
    
    print(f"Total eliminados: {cleaned}")
    return cleaned

def check_files():
    """Verifica archivos principales"""
    print("Verificando archivos principales...")
    
    required_files = [
        'sueño-andino-clone.html',
        'sueño-andino-wordpress.html',
        'blog-sueño-andino.html',
        'README.md',
        'package.json',
        '.gitignore'
    ]
    
    missing = []
    for file in required_files:
        if os.path.exists(file):
            print(f"  [OK] {file}")
        else:
            print(f"  [MISSING] {file}")
            missing.append(file)
    
    return len(missing) == 0

def main():
    print("Sueño Andino - Optimizador Simple")
    print("=" * 40)
    
    # Limpiar caché
    cleaned = clean_cache()
    
    # Verificar archivos
    files_ok = check_files()
    
    print("=" * 40)
    print("Optimizacion completada!")
    print(f"Archivos eliminados: {cleaned}")
    print(f"Archivos principales: {'OK' if files_ok else 'Problemas'}")
    print("=" * 40)

if __name__ == "__main__":
    main()
