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

    // Replace all blue-* tailwind classes with sky-* equivalents
    // bg-blue-* -> bg-sky-*
    content = content.replace(/\bbg-blue-(\d+)/g, 'bg-sky-$1');
    // text-blue-* -> text-sky-*
    content = content.replace(/\btext-blue-(\d+)/g, 'text-sky-$1');
    // border-blue-* -> border-sky-*
    content = content.replace(/\bborder-blue-(\d+)/g, 'border-sky-$1');
    // shadow-blue-* -> shadow-sky-*
    content = content.replace(/\bshadow-blue-(\d+)/g, 'shadow-sky-$1');
    // from-blue-* -> from-sky-*
    content = content.replace(/\bfrom-blue-(\d+)/g, 'from-sky-$1');
    // via-blue-* -> via-sky-*
    content = content.replace(/\bvia-blue-(\d+)/g, 'via-sky-$1');
    // to-blue-* -> to-sky-*
    content = content.replace(/\bto-blue-(\d+)/g, 'to-sky-$1');
    // hover:bg-blue-* -> hover:bg-sky-*
    content = content.replace(/\bhover:bg-blue-(\d+)/g, 'hover:bg-sky-$1');
    // hover:text-blue-* -> hover:text-sky-*
    content = content.replace(/\bhover:text-blue-(\d+)/g, 'hover:text-sky-$1');
    // hover:border-blue-* -> hover:border-sky-*
    content = content.replace(/\bhover:border-blue-(\d+)/g, 'hover:border-sky-$1');
    // ring-blue-* -> ring-sky-*
    content = content.replace(/\bring-blue-(\d+)/g, 'ring-sky-$1');

    if (original !== content) {
        fs.writeFileSync(file, content);
        totalChanges++;
        console.log('Updated: ' + file);
    }
});
console.log('Total files updated: ' + totalChanges);
