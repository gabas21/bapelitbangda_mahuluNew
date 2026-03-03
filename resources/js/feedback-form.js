/**
 * Feedback Form Alpine.js Component
 * Used on the landing page Section 6: Aspirasi & Pengaduan
 * Sends data to POST /feedback
 */
document.addEventListener('alpine:init', () => {
    Alpine.data('feedbackForm', () => ({
        formData: {
            nama: '',
            no_hp: '',
            pesan: ''
        },
        isSubmitting: false,
        showSuccess: false,
        errorMessage: '',

        async submitForm() {
            this.isSubmitting = true;
            this.errorMessage = '';

            try {
                const response = await fetch('/feedback', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify(this.formData),
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    this.showSuccess = true;
                    this.formData.nama = '';
                    this.formData.no_hp = '';
                    this.formData.pesan = '';
                } else {
                    // Handle validation errors
                    if (data.errors) {
                        const firstError = Object.values(data.errors)[0];
                        this.errorMessage = Array.isArray(firstError) ? firstError[0] : firstError;
                    } else {
                        this.errorMessage = data.message || 'Terjadi kesalahan. Silakan coba lagi.';
                    }
                }
            } catch (error) {
                this.errorMessage = 'Gagal mengirim. Periksa koneksi internet Anda.';
            } finally {
                this.isSubmitting = false;
            }
        },

        closeModal() {
            this.showSuccess = false;
        }
    }));
});
