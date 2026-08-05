import os
import re

files = [
    'app/Providers/AppServiceProvider.php',
    'resources/views/layouts/footer.blade.php',
    'resources/views/components/Labkesda/labkesda.blade.php',
    'resources/views/components/LayananTerpadu/layanan-terpadu.blade.php',
    'resources/views/components/Lihat_semua/agenda.blade.php',
    'resources/views/components/Lihat_semua/berita.blade.php',
    'resources/views/components/Lihat_semua/media.blade.php',
    'resources/views/components/Profile/profile.blade.php'
]

pattern = re.compile(r'<<<<<<< HEAD\r?\n(.*?)\r?\n=======\r?\n.*?\r?\n>>>>>>> [a-f0-9]+\r?\n', re.DOTALL)

for f in files:
    if os.path.exists(f):
        with open(f, 'r', encoding='utf-8') as file:
            content = file.read()
        
        new_content = pattern.sub(r'\g<1>\n', content)
        
        with open(f, 'w', encoding='utf-8') as file:
            file.write(new_content)
        print(f"Fixed {f}")
