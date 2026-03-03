const fs = require('fs');
const path = require('path');

const svgPath = path.join(__dirname, 'public', 'images', 'Desain tanpa judul.svg');
const outPath = path.join(__dirname, 'public', 'images', 'Mahakam_Ulu_HighRes.jpg');

try {
    const svgContent = fs.readFileSync(svgPath, 'utf8');
    const match = svgContent.match(/href="data:image\/jpeg;base64,([^"]+)"/);
    if (match && match[1]) {
        const base64Data = match[1];
        const buffer = Buffer.from(base64Data, 'base64');
        fs.writeFileSync(outPath, buffer);
        console.log('Successfully extracted Mahakam_Ulu_HighRes.jpg. Size:', buffer.length);
    } else {
        const matchPng = svgContent.match(/href="data:image\/png;base64,([^"]+)"/);
        if (matchPng && matchPng[1]) {
            const base64Data = matchPng[1];
            const buffer = Buffer.from(base64Data, 'base64');
            const outPathPng = path.join(__dirname, 'public', 'images', 'Mahakam_Ulu_HighRes.png');
            fs.writeFileSync(outPathPng, buffer);
            console.log('Successfully extracted Mahakam_Ulu_HighRes.png. Size:', buffer.length);
        } else {
            console.log('Could not find base64 image data in SVG');
        }
    }
} catch (e) {
    console.error('Error:', e.message);
}
