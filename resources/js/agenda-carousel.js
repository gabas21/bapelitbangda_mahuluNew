/**
 * Agenda Carousel Alpine.js Component
 * Used on the landing page Section 4: Agenda Inspektorat
 */
document.addEventListener('alpine:init', () => {
    Alpine.data('agendaCarousel', () => ({
        items: window.__agendaItems || [],
        search: '',
        searchDate: '',
        filtered: [],
        position: 0,
        dragging: false,
        startX: 0,
        dragDelta: 0,
        startTime: 0,
        gap: 16,
        perPage: 3,

        get cardW() {
            const el = this.$refs.wrap;
            if (!el) return 350;
            const w = el.offsetWidth;
            if (window.innerWidth < 640) return w;
            if (window.innerWidth < 1024) return (w - this.gap) / 2;
            return (w - this.gap * 2) / 3;
        },

        get maxPos() {
            const visible = window.innerWidth < 640 ? 1 : window.innerWidth < 1024 ? 2 : 3;
            return Math.max(0, this.filtered.length - visible);
        },

        get totalDots() {
            return this.maxPos + 1;
        },

        cardTransform(idx) {
            const visible = this.perPage;
            let pos = this.position;
            if (this.dragging) {
                const step = this.cardW + this.gap;
                if (step > 0) pos = this.position - (this.dragDelta / step);
            }
            const offset = idx - pos;
            const op = (offset >= 0 && offset < visible) ? 1 : 0.6;
            const t = this.dragging
                ? 'transition:opacity 0.15s ease;'
                : 'transition:opacity 0.4s ease;';
            return `opacity:${op}; ${t}`;
        },

        get tx() {
            const base = -(this.position * (this.cardW + this.gap));
            if (this.dragging) {
                let d = this.dragDelta;
                if (this.position <= 0 && d > 0) d = d * 0.3;
                if (this.position >= this.maxPos && d < 0) d = d * 0.3;
                return base + d;
            }
            return base;
        },

        init() {
            this.filtered = [...this.items];
            const updatePerPage = () => {
                if (window.innerWidth < 640) this.perPage = 1;
                else if (window.innerWidth < 1024) this.perPage = 2;
                else this.perPage = 3;
                if (this.position > this.maxPos) this.position = this.maxPos;
            };
            updatePerPage();
            window.addEventListener('resize', updatePerPage);
        },

        onSearch() {
            const q = this.search.toLowerCase().trim();
            const formatInputDate = (dStr) => {
                if (!dStr) return null;
                const d = new Date(dStr);
                if (isNaN(d)) return null;
                return d;
            };

            const filterTargetDate = formatInputDate(this.searchDate);

            this.filtered = this.items.filter(item => {
                let matchText = true;
                if (q) {
                    matchText = item.title.toLowerCase().includes(q) ||
                        item.description.toLowerCase().includes(q) ||
                        item.location.toLowerCase().includes(q) ||
                        item.date.toLowerCase().includes(q);
                }

                let matchDate = true;
                if (filterTargetDate) {
                    const targetDay = filterTargetDate.getDate().toString().padStart(2, '0');
                    const itemDate = new Date(item.date);
                    if (!isNaN(itemDate)) {
                        matchDate = itemDate.toDateString() === filterTargetDate.toDateString();
                    } else {
                        matchDate = item.date.includes(targetDay);
                    }
                }

                return matchText && matchDate;
            });
            this.position = 0;
        },

        prev() { this.position = Math.max(0, this.position - 1); },
        next() { this.position = Math.min(this.maxPos, this.position + 1); },
        goTo(p) { this.position = Math.max(0, Math.min(p, this.maxPos)); },

        onDown(e) {
            this.dragging = true;
            this.startX = e.type.includes('touch') ? e.touches[0].clientX : e.clientX;
            this.dragDelta = 0;
            this.startTime = Date.now();
        },
        onMove(e) {
            if (!this.dragging) return;
            const x = e.type.includes('touch') ? e.touches[0].clientX : e.clientX;
            this.dragDelta = x - this.startX;
        },
        onUp() {
            if (!this.dragging) return;
            this.dragging = false;
            const elapsed = Math.max((Date.now() - this.startTime) / 1000, 0.01);
            const v = this.dragDelta / elapsed;
            let dir = 0;
            if (this.dragDelta < -30 || v < -400) dir = 1;
            else if (this.dragDelta > 30 || v > 400) dir = -1;
            this.dragDelta = 0;
            if (dir) {
                const n = this.position + dir;
                this.position = Math.max(0, Math.min(n, this.maxPos));
            }
        },
    }));
});
