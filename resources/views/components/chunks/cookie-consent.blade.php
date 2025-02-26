<div x-data="{
    showConsent: false,
    accept() {
        if (this.accepted()) {
            return
        }

        const date = new Date();
        date.setTime(date.getTime() + (365 * 24 * 60 * 60 * 1000));
        const expires = `expires=${date.toUTCString()}`;
        document.cookie = `CookieConsent=accepted; ${expires}; path=/`;
    },
    accepted() {
        const cookie = `; ${document.cookie}`
        const parts = cookie.split(`; CookieConsent=`)
        const value = (parts.length === 2) ? parts.pop().split(';').shift() : null

        return `accepted` === value
    }
}" x-init="showConsent = !accepted()">

</div>
