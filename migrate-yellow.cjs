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
let totalChanges = 0;

files.forEach(file => {
    let content = fs.readFileSync(file, 'utf8');
    let original = content;

    // The user wants yellow to match blue. We'll replace hardcoded 'gold' and 'amber-*' with 'yellow-400' or similar
    // Instead of doing arbitrary tailwind replacements, we'll replace the specific gold hex colors and amber classes

    // In Laravel apps with custom schemes, let's search for "bg-gold", "text-gold", "border-gold" etc.
    // We already have `--color-accent` mapped to yellow 400. 
    // The tailwind config might have `gold: '#F59E0B'` which we can't change from here. 
    // But we CAN replace the classes `text-gold` with `text-instansi-highlight` or `text-yellow-400`.

    content = content.replace(/\btext-gold\b/g, 'text-yellow-400');
    content = content.replace(/\bbg-gold\b/g, 'bg-yellow-400');
    content = content.replace(/\bborder-gold\b/g, 'border-yellow-400');
    content = content.replace(/\bfrom-gold\b/g, 'from-yellow-400');
    content = content.replace(/\bvia-gold\b/g, 'via-yellow-400');
    content = content.replace(/\bto-gold\b/g, 'to-yellow-400');
    content = content.replace(/\bshadow-gold\b/g, 'shadow-yellow-400');
    content = content.replace(/\bhover:text-gold\b/g, 'hover:text-yellow-300');
    content = content.replace(/\bhover:bg-gold\b/g, 'hover:bg-yellow-300');

    // Also replace hardcoded amber colors
    content = content.replace(/\btext-amber-(\d+)\b/g, 'text-yellow-$1');
    content = content.replace(/\bbg-amber-(\d+)\b/g, 'bg-yellow-$1');
    content = content.replace(/\bborder-amber-(\d+)\b/g, 'border-yellow-$1');
    content = content.replace(/\bfrom-amber-(\d+)\b/g, 'from-yellow-$1');
    content = content.replace(/\bvia-amber-(\d+)\b/g, 'via-yellow-$1');
    content = content.replace(/\bto-amber-(\d+)\b/g, 'to-yellow-$1');

    // Replace hardcoded RGB of the old amber #F59E0B (245, 158, 11) with yellow #FBBF24 (251, 191, 36)
    content = content.replace(/245,\s*158,\s*11/g, '251, 191, 36');
    // Replace hex
    content = content.replace(/#F59E0B/ig, '#FBBF24');

    if (original !== content) {
        fs.writeFileSync(file, content);
        totalChanges++;
        console.log('Updated: ' + file);
    }
});
console.log('Total files updated: ' + totalChanges);
