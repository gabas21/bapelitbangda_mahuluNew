const fs = require('fs');
const path = require('path');

function walk(dir) {
    let results = [];
    const list = fs.readdirSync(dir);
    list.forEach(file => {
        file = path.join(dir, file);
        const stat = fs.statSync(file);
        if (stat && stat.isDirectory()) {
            results = results.concat(walk(file));
        } else {
            if (file.endsWith('.blade.php')) results.push(file);
        }
    });
    return results;
}

const files = walk('resources/views');

files.forEach(file => {
    let content = fs.readFileSync(file, 'utf8');
    let original = content;

    // Backgrounds
    content = content.replace(/bg-navy-dark/g, 'bg-white');
    content = content.replace(/bg-navy-light/g, 'bg-slate-100');
    content = content.replace(/bg-navy-lighter/g, 'bg-slate-200');
    content = content.replace(/bg-navy/g, 'bg-instansi-surface');
    content = content.replace(/bg-cream/g, 'bg-white');
    content = content.replace(/bg-rose-dark/g, 'bg-instansi-hover');
    content = content.replace(/bg-rose-light/g, 'bg-blue-400');
    content = content.replace(/bg-rose/g, 'bg-instansi-action');
    content = content.replace(/bg-lavender-dark/g, 'bg-slate-300');
    content = content.replace(/bg-lavender-light/g, 'bg-slate-100');
    content = content.replace(/bg-lavender/g, 'bg-slate-200');

    // Texts
    content = content.replace(/text-navy-dark/g, 'text-instansi-primary');
    content = content.replace(/text-navy-light/g, 'text-blue-500');
    content = content.replace(/text-navy/g, 'text-instansi-primary');
    content = content.replace(/text-cream/g, 'text-instansi-text-main');
    content = content.replace(/text-rose-dark/g, 'text-instansi-hover');
    content = content.replace(/text-rose-light/g, 'text-blue-400');
    content = content.replace(/text-rose/g, 'text-instansi-action');
    content = content.replace(/text-lavender-dark/g, 'text-slate-500');
    content = content.replace(/text-lavender-light/g, 'text-slate-300');
    content = content.replace(/text-lavender/g, 'text-instansi-text-muted');

    // Borders
    content = content.replace(/border-navy-dark/g, 'border-slate-300');
    content = content.replace(/border-navy-light/g, 'border-slate-200');
    content = content.replace(/border-navy/g, 'border-slate-300');
    content = content.replace(/border-cream/g, 'border-slate-200');
    content = content.replace(/border-rose-dark/g, 'border-instansi-hover');
    content = content.replace(/border-rose/g, 'border-instansi-action');
    content = content.replace(/border-lavender-dark/g, 'border-slate-400');
    content = content.replace(/border-lavender-light/g, 'border-slate-200');
    content = content.replace(/border-lavender/g, 'border-slate-300');

    // Shadow
    content = content.replace(/shadow-navy/g, 'shadow-slate-300');
    content = content.replace(/shadow-cream/g, 'shadow-slate-100');
    content = content.replace(/shadow-rose/g, 'shadow-blue-500');

    if (original !== content) {
        fs.writeFileSync(file, content);
    }
});
console.log('Migration complete.');
