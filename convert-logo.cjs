const sharp = require('sharp');
const path = require('path');
const fs = require('fs');

const pngPath = path.join(__dirname, 'public', 'images', 'Mahakam_Ulu_HD.png');
const outputWebp = path.join(__dirname, 'public', 'images', 'Mahakam_Ulu_HD.webp');

async function convert() {
    try {
        await sharp(pngPath)
            .webp({
                quality: 95,
                effort: 6
            })
            .toFile(outputWebp);

        const meta = await sharp(outputWebp).metadata();
        const size = fs.statSync(outputWebp).size;
        console.log('HD webp dimensions:', meta.width, 'x', meta.height);
        console.log('HD webp file size:', (size / 1024).toFixed(1), 'KB');
        console.log('Done!');
    } catch (err) {
        console.error('Error:', err.message);
    }
}

convert();
