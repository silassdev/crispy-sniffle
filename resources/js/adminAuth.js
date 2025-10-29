export function adminAuth() {
  return {
    open: false,
    mode: 'login',
    loading: false,
    error: '',
    form: {
      email: '',
      fullname: '',
      username: '',
      password: '',
      password_confirmation: '',
      remember: false
    },
    toast: { show: false, message: '', type: 'success', progress: 100, duration: 3500 },

    showToast(message, type = 'success', duration =3500) {
      if(this.toast.raf)
    cancelAnimationFrame(this.toast.raf);

      this.toast.message = message;
      this.toast.type = type;
      this.toast.duration = duration;
      this.toast.show = true;
      this.toast.progress = 100;
      this.toast.startAt = performance.now();

      const step = (now) => {
        const elapsed = now - this.toast.startAt;
        const pct = Math.max(0, 100 - (elapsed / this.toast.duration) * 100);
        this.toast.progress = pct;
        if (elapsed < this.toast.duration) {
          this.toast.raf = requestAnimationFrame(step);
        } else {
          this.toast.show = false;
          this.toast.raf = null;
        }
      };
      this.toast.raf = requestAnimationFrame(step);
    },

    init() {
      window.addEventListener('open-admin', () => {
        this.open = true
        this.$nextTick(() => {
          try {
            if (this.$refs?.adminEmail) this.$refs.adminEmail.focus()
          } catch (e) {}
        });
        window.addEventListener('show-global-toast', (e) => {
          const payload = (e?.detail && typeof e.detail === 'object') ? e.detail : { message: String(e?.detail || '')};
          this.showToast(payload.message || '', payload.type || 'success', payload.duration || 3500);
        });
      })
    },

    async submit() {
      this.error = ''
      this.loading = true

      // ✅ Client-side checks
      if (this.mode === 'signup' && this.form.password.length < 6) {
        this.error = 'Password must be at least 6 characters'
        this.showToast(this.error, 'error')
        this.loading = false
        return
      }
      if (this.mode === 'signup' && this.form.password !== this.form.password_confirmation) {
        this.error = 'Passwords do not match'
        this.showToast(this.error, 'error')
        this.loading = false
        return
      }

      const url =
        this.mode === 'login'
          ? window.routes?.adminLogin ?? '/admin/login'
          : window.routes?.adminRegister ?? '/admin/register'

      const token = document.querySelector('meta[name="csrf-token"]').content

      try {
        const res = await fetch(url, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token,
            'X-Requested-With': 'XMLHttpRequest',
            Accept: 'application/json'
          },
          body: JSON.stringify(this.form),
          credentials: 'same-origin'
        })

        const payload = await res.json().catch(() => ({}))
        console.log('POST', url, res.status, payload)

        if (res.ok && payload.ok) {
          this.form.password = ''
          this.form.password_confirmation = ''
          this.showToast(payload.message || 'Success', 'success')

          if (this.mode === 'signup') {
            this.mode = 'login'
            if (payload.email) this.form.email = payload.email
            this.$nextTick(() => this.$refs?.adminEmail?.focus())
          } else if (this.mode === 'login' && payload.redirect) {
            window.location.href = payload.redirect
          }
          return
        }

        if (res.status === 422 && payload?.errors) {
          const first = Object.values(payload.errors)[0]
          this.error = Array.isArray(first) ? first[0] : first
          this.showToast(this.error, 'error')
          return
        }

        this.error = payload?.raw || 'Request failed, check console'
        this.showToast(this.error, 'error')
      } catch (err) {
        console.error('submit error', err)
        this.error = 'Network or Server error'
        this.showToast(this.error, 'error')
      } finally {
        this.loading = false
      }
    }
  }
}