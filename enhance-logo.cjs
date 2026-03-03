const sharp = require('sharp');
const path = require('path');

const inputPath = path.join(__dirname, 'public', 'images', 'Mahakam_Ulu.webp');
const outputPng = path.join(__dirname, 'public', 'images', 'Mahakam_Ulu_HD.png');

async function enhance() {
    try {
        // First, get the original image info
        const metadata = await sharp(inputPath).metadata();
        console.log('Original dimensions:', metadata.width, 'x', metadata.height);
        console.log('Original format:', metadata.format);

        // Upscale to 4x the original size with high-quality interpolation, then sharpen
        const targetWidth = metadata.width * 4;
        const targetHeight = metadata.height * 4;

        await sharp(inputPath)
            .resize(targetWidth, targetHeight, {
                kernel: sharp.kernel.lanczos3,  // Best quality interpolation
                fit: 'contain',
                background: { r: 0, g: 0, b: 0, alpha: 0 }  // Transparent background
            })
            .sharpen({
                sigma: 1.2,      // Sharpening radius
                m1: 1.5,         // Flat area sharpening
                m2: 1.0          // Jagged area sharpening
            })
            .png({
                quality: 100,
                compressionLevel: 6
            })
            .toFile(outputPng);

        const newMeta = await sharp(outputPng).metadata();
        console.log('Enhanced dimensions:', newMeta.width, 'x', newMeta.height);
        console.log('Output saved to:', outputPng);

        // Also create an optimized webp version at the same high resolution
        const outputWebp = path.join(__dirname, 'public', 'images', 'Mahakam_Ulu.webp');

        // Backup original first
        const fs = require('fs');
        const backupPath = path.join(__dirname, 'public', 'images', 'Mahakam_Ulu_original.webp');
        if (!fs.existsSync(backupPath)) {
            fs.copyFileSync(inputPath, backupPath);
            console.log('Original backed up to:', backupPath);
        }

        // Create high-quality webp replacement
        await sharp(outputPng)
            .webp({
                quality: 95,       // High quality
                effort: 6,         // Max compression effort
                lossless: false     // Near-lossless for better file size
            })
            .toFile(outputWebp);

        const finalMeta = await sharp(outputWebp).metadata();
        const finalSize = fs.statSync(outputWebp).size;
        console.log('New webp dimensions:', finalMeta.width, 'x', finalMeta.height);
        console.log('New webp file size:', (finalSize / 1024).toFixed(1), 'KB');
        console.log('Done! Logo has been enhanced successfully.');
    } catch (err) {
        console.error('Error:', err.message);
    }
}

enhance();
