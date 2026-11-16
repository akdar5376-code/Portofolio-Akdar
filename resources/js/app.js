const root = document.documentElement;

document.querySelectorAll('[data-theme-toggle]').forEach((button) => {
    button.addEventListener('click', () => {
        const isDark = root.classList.toggle('dark');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');

        document.querySelectorAll('[data-theme-label]').forEach((label) => {
            label.textContent = isDark ? 'Mode Terang' : 'Mode Gelap';
        });
    });
});

document.querySelectorAll('[data-mobile-nav-toggle]').forEach((button) => {
    button.addEventListener('click', () => {
        const panel = document.querySelector('[data-mobile-nav]');

        if (!panel) {
            return;
        }

        const isOpen = panel.classList.toggle('hidden') === false;
        button.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });
});

document.querySelectorAll('[data-mobile-nav] a').forEach((link) => {
    link.addEventListener('click', () => {
        document.querySelector('[data-mobile-nav]')?.classList.add('hidden');
        document.querySelector('[data-mobile-nav-toggle]')?.setAttribute('aria-expanded', 'false');
    });
});

const adminSidebar = document.querySelector('[data-admin-sidebar]');
const adminOverlay = document.querySelector('[data-admin-overlay]');

document.querySelectorAll('[data-admin-sidebar-toggle]').forEach((button) => {
    button.addEventListener('click', () => {
        adminSidebar?.classList.toggle('-translate-x-full');
        adminOverlay?.classList.toggle('hidden');
    });
});

adminOverlay?.addEventListener('click', () => {
    adminSidebar?.classList.add('-translate-x-full');
    adminOverlay.classList.add('hidden');
});

const backToTop = document.querySelector('[data-back-to-top]');

if (backToTop) {
    const updateBackToTop = () => {
        backToTop.dataset.hidden = window.scrollY > 420 ? 'false' : 'true';
    };

    updateBackToTop();
    window.addEventListener('scroll', updateBackToTop, { passive: true });

    backToTop.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
}

document.querySelectorAll('[data-scroll-top]').forEach((link) => {
    link.addEventListener('click', (event) => {
        event.preventDefault();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
});

const previewModal = document.querySelector('[data-project-preview-modal]');

if (previewModal) {
    const closeButton = previewModal.querySelector('[data-preview-close]');
    const fields = {
        title: previewModal.querySelector('[data-preview-title]'),
        category: previewModal.querySelector('[data-preview-category]'),
        image: previewModal.querySelector('[data-preview-image]'),
        description: previewModal.querySelector('[data-preview-description]'),
        problem: previewModal.querySelector('[data-preview-problem]'),
        goal: previewModal.querySelector('[data-preview-goal]'),
        tech: previewModal.querySelector('[data-preview-tech]'),
        role: previewModal.querySelector('[data-preview-role]'),
        demo: previewModal.querySelector('[data-preview-demo]'),
        github: previewModal.querySelector('[data-preview-github]'),
        detail: previewModal.querySelector('[data-preview-detail]'),
    };

    const closeModal = () => {
        previewModal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('overflow-hidden');
    };

    document.querySelectorAll('[data-project-preview]').forEach((trigger) => {
        trigger.addEventListener('click', () => {
            const data = trigger.dataset;

            if (fields.title) {
                fields.title.textContent = data.title ?? '';
            }

            if (fields.category) {
                fields.category.textContent = data.category ?? '';
            }

            if (fields.image) {
                if (data.image) {
                    fields.image.src = data.image;
                    fields.image.alt = data.title ?? '';
                    fields.image.classList.remove('hidden');
                } else {
                    fields.image.removeAttribute('src');
                    fields.image.alt = '';
                    fields.image.classList.add('hidden');
                }
            }

            if (fields.description) {
                fields.description.textContent = data.description ?? 'Belum ada deskripsi.';
            }

            if (fields.problem) {
                fields.problem.textContent = data.problem || 'Belum diisi.';
            }

            if (fields.goal) {
                fields.goal.textContent = data.goal || 'Belum diisi.';
            }

            if (fields.role) {
                fields.role.textContent = data.role || 'Belum diisi.';
            }

            if (fields.tech) {
                fields.tech.innerHTML = '';

                (data.tech ?? '')
                    .split(',')
                    .map((item) => item.trim())
                    .filter(Boolean)
                    .forEach((item) => {
                        const chip = document.createElement('span');
                        chip.className =
                            'rounded-full border border-surface-highest bg-surface-container px-3 py-1 font-mono text-[11px] text-on-surface-variant';
                        chip.textContent = item;
                        fields.tech.appendChild(chip);
                    });
            }

            if (fields.demo) {
                fields.demo.href = data.demo || '#';
                fields.demo.classList.toggle('hidden', !data.demo);
            }

            if (fields.github) {
                fields.github.href = data.github || '#';
                fields.github.classList.toggle('hidden', !data.github);
            }

            if (fields.detail) {
                fields.detail.href = data.detail || '#';
            }

            previewModal.setAttribute('aria-hidden', 'false');
            document.body.classList.add('overflow-hidden');
            closeButton?.focus();
        });
    });

    closeButton?.addEventListener('click', closeModal);

    previewModal.addEventListener('click', (event) => {
        if (event.target === previewModal) {
            closeModal();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            closeModal();
        }
    });
}

const toast = document.querySelector('[data-toast]');

if (toast) {
    window.setTimeout(() => {
        toast.classList.add('translate-y-20', 'opacity-0');
    }, 3600);
}

document.querySelectorAll('form[data-confirm]').forEach((form) => {
    form.addEventListener('submit', (event) => {
        if (!window.confirm(form.dataset.confirm)) {
            event.preventDefault();
        }
    });
});

document.querySelectorAll('input[type="file"][data-filename-target]').forEach((input) => {
    input.addEventListener('change', () => {
        const target = document.querySelector(input.dataset.filenameTarget);

        if (target && input.files.length) {
            target.textContent = input.files[0].name;
        }
    });
});
