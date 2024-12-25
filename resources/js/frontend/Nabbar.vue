<script>
export default {
    name: "Navbar",
    props: {
        siteSetting: Object,
        auth: Object
    },
    data() {
        return {
            locale: localStorage.getItem('locale') || 'bn'
        };
    },
    methods: {
        getLogoUrl(logoPath) {
            if (!logoPath) {
                return 'default-logo.png';
            }
            return `${window.location.origin}/${logoPath}`;
        },

        changeLanguage(lang) {
            this.locale = lang;
            localStorage.setItem('locale', lang);
            window.location.reload();
        },
        redirectToDashboard() {
            window.location.href = "/user/dashboard";
        }
    },
}
</script>

<template>
    <header class="site-header-area" id="garments-niyog-header">
        <div class="container">
            <div class="site-header-wrapper">
                <div class="menu-left">
                    <Link href="/">
                        <img :src="getLogoUrl(siteSetting?.logo)" alt="">
                    </Link>
                    <nav class="site-navigation d-none d-lg-block">
                        <ul class="menu-list">
                            <li>
                                <Link href="/">
                                    {{ locale === 'en' ? 'Home' : 'হোম' }}
                                </Link>
                            </li>
                            <li>
                                <Link href="/about-us">
                                    {{ locale === 'en' ? 'About Us' : 'আমাদের সম্পর্কে' }}
                                </Link>
                            </li>
                            <li>
                                <Link href="/job-board">
                                    {{ locale === 'en' ? 'Browse Job' : 'জব' }}
                                </Link>
                            </li>
                            <li>
                                <Link href="/training">
                                    {{ locale === 'en' ? 'Training' : 'প্রশিক্ষণ' }}

                                </Link>
                            </li>
                            <li class="dropdown">
                                <a
                                    href="#"
                                    role="button"
                                    class="dropdown-toggle"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                >  {{ locale === 'en' ? 'Resources' : 'রিসোর্স' }}
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                    >
                                        <path
                                            d="M18 9.00005C18 9.00005 13.5811 15 12 15C10.4188 15 6 9 6 9"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <Link href="/event"
                                        ><svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="16"
                                            height="17"
                                            viewBox="0 0 16 17"
                                            fill="none"
                                        >
                                            <path
                                                d="M12.6667 2.50008H12V1.16675H10.6667V2.50008H5.33333V1.16675H4V2.50008H3.33333C2.97971 2.50008 2.64057 2.64056 2.39052 2.89061C2.14048 3.14065 2 3.47979 2 3.83341V13.1667C2 13.5204 2.14048 13.8595 2.39052 14.1096C2.64057 14.3596 2.97971 14.5001 3.33333 14.5001H12.6667C13.4067 14.5001 14 13.9067 14 13.1667V3.83341C14 3.47979 13.8595 3.14065 13.6095 2.89061C13.3594 2.64056 13.0203 2.50008 12.6667 2.50008ZM12.6667 13.1667H3.33333V6.50008H12.6667V13.1667ZM12.6667 5.16675H3.33333V3.83341H12.6667V5.16675Z"
                                                fill="currentColor"
                                            />
                                        </svg>

                                            {{ locale === 'en' ? 'Events' : 'ইভেন্ট' }}
                                        </Link>
                                    </li>

                                    <li>
                                        <Link href="/blog">
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="16"
                                                height="17"
                                                viewBox="0 0 16 17"
                                                fill="none"
                                            >
                                                <path
                                                    d="M14.526 1.4866L14.9194 1.87994C15.4614 2.4226 15.3794 3.3846 14.7347 4.0286L6.62337 12.1399L3.99537 13.1013C3.66537 13.2226 3.34404 13.0653 3.2787 12.7513C3.25669 12.6374 3.26709 12.5196 3.3087 12.4113L4.2887 9.7606L12.3774 1.67127C13.022 1.02727 13.984 0.943935 14.526 1.4866ZM6.26937 2.29327C6.35692 2.29327 6.44361 2.31051 6.52449 2.34402C6.60537 2.37752 6.67887 2.42663 6.74077 2.48853C6.80268 2.55044 6.85178 2.62393 6.88529 2.70481C6.91879 2.7857 6.93603 2.87239 6.93603 2.95994C6.93603 3.04748 6.91879 3.13417 6.88529 3.21506C6.85178 3.29594 6.80268 3.36943 6.74077 3.43134C6.67887 3.49325 6.60537 3.54235 6.52449 3.57586C6.44361 3.60936 6.35692 3.6266 6.26937 3.6266H3.6027C3.24908 3.6266 2.90994 3.76708 2.65989 4.01713C2.40984 4.26717 2.26937 4.60631 2.26937 4.95994V12.9599C2.26937 13.3136 2.40984 13.6527 2.65989 13.9027C2.90994 14.1528 3.24908 14.2933 3.6027 14.2933H11.6027C11.9563 14.2933 12.2955 14.1528 12.5455 13.9027C12.7956 13.6527 12.936 13.3136 12.936 12.9599V10.2933C12.936 10.1165 13.0063 9.94689 13.1313 9.82187C13.2563 9.69684 13.4259 9.6266 13.6027 9.6266C13.7795 9.6266 13.9491 9.69684 14.0741 9.82187C14.1991 9.94689 14.2694 10.1165 14.2694 10.2933V12.9599C14.2694 13.6672 13.9884 14.3455 13.4883 14.8456C12.9882 15.3457 12.3099 15.6266 11.6027 15.6266H3.6027C2.89546 15.6266 2.21718 15.3457 1.71708 14.8456C1.21699 14.3455 0.936035 13.6672 0.936035 12.9599V4.95994C0.936035 4.25269 1.21699 3.57441 1.71708 3.07432C2.21718 2.57422 2.89546 2.29327 3.6027 2.29327H6.26937Z"
                                                    fill="currentColor"
                                                />
                                            </svg>

                                            {{ locale === 'en' ? 'Blogs' : 'ব্লগ' }}
                                        </Link>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <Link href="/contact">
                                    {{ locale === 'en' ? 'Contact Us' : 'যোগাযোগ' }}
                                </Link>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="menu-right">
                    <button
                        id="languageSwitcher"
                        class="switcher"
                        role="switch"
                        :aria-checked="locale === 'en'"
                        @click="changeLanguage(locale === 'en' ? 'bn' : 'en')"
                    >
                        <span class="language" :class="{ active: locale === 'en' }">EN</span>
                        <div class="toggle" :class="{ active: locale === 'en' }"></div>
                        <span class="language" :class="{ active: locale === 'bn' }">BN </span>
                    </button>
                    <div class="d-block d-lg-none">
                        <button
                            class="navbar-toggler"
                            type="button"
                            data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasNavbar"
                            aria-controls="offcanvasNavbar"
                            aria-label="Toggle navigation"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                strokeWidth="2"
                                stroke="currentColor"
                            >
                                <path
                                    strokeLinecap="round"
                                    strokeLinejoin="round"
                                    d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
                                />
                            </svg>
                        </button>
                    </div>

                    <div v-if="auth && auth.role === 'user'">
                        <a @click="redirectToDashboard" class="theme-btn d-none d-lg-block">

                            <span v-if="locale === 'en'"> {{ auth.name }}</span>
                            <span v-else> {{ auth.name_bn }}</span>
                        </a>
                    </div>
                    <div v-else>
                        <a href="/login" class="theme-btn d-none d-lg-block"
                        >{{ locale === 'en' ? 'SignUp / SignIn' : 'লগইন/রেজিস্ট্রেশন' }}</a
                        >
                    </div>


                    <a href="/company-registration-start" class="theme-btn d-none d-lg-block"
                    >{{ locale === 'en' ? 'Company ' : 'কোম্পানি' }}</a
                    >
                </div>
            </div>
        </div>
    </header>

    <div
        class="offcanvas offcanvas-end mobile-device-offcanvas"
        tabindex="-1"
        id="offcanvasNavbar"
        aria-labelledby="offcanvasNavbarLabel"
    >
        <div class="offcanvas-header">
            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="offcanvas"
                aria-label="Close"
            ></button>
        </div>
        <div class="offcanvas-body">
            <div class="menu-left">
                <nav class="site-navigation">
                    <ul class="menu-list">
                        <li>
                            <Link href="/">
                                {{ locale === 'en' ? 'Home' : 'হোম' }}
                            </Link>
                        </li>
                        <li>
                            <Link href="/about-us">
                                {{ locale === 'en' ? 'About Us' : 'আমাদের সম্পর্কে' }}
                            </Link>
                        </li>
                        <li>
                            <Link href="/job-board">
                                {{ locale === 'en' ? 'Browse Job' : 'জব' }}
                            </Link>
                        </li>
                        <li>
                            <Link href="/training">
                                {{ locale === 'en' ? 'Training' : 'প্রশিক্ষণ' }}

                            </Link>
                        </li>



                        <li class="dropdown">
                            <a
                                href="#"
                                role="button"
                                class="dropdown-toggle"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                            >{{ locale === 'en' ? 'Resources' : 'রিসোর্স' }}
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                >
                                    <path
                                        d="M18 9.00005C18 9.00005 13.5811 15 12 15C10.4188 15 6 9 6 9"
                                        stroke="currentColor"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />
                                </svg>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <Link href="/event"
                                    ><svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="16"
                                        height="17"
                                        viewBox="0 0 16 17"
                                        fill="none"
                                    >
                                        <path
                                            d="M12.6667 2.50008H12V1.16675H10.6667V2.50008H5.33333V1.16675H4V2.50008H3.33333C2.97971 2.50008 2.64057 2.64056 2.39052 2.89061C2.14048 3.14065 2 3.47979 2 3.83341V13.1667C2 13.5204 2.14048 13.8595 2.39052 14.1096C2.64057 14.3596 2.97971 14.5001 3.33333 14.5001H12.6667C13.4067 14.5001 14 13.9067 14 13.1667V3.83341C14 3.47979 13.8595 3.14065 13.6095 2.89061C13.3594 2.64056 13.0203 2.50008 12.6667 2.50008ZM12.6667 13.1667H3.33333V6.50008H12.6667V13.1667ZM12.6667 5.16675H3.33333V3.83341H12.6667V5.16675Z"
                                            fill="currentColor"
                                        />
                                    </svg>
                                        {{ locale === 'en' ? 'Events' : 'ইভেন্ট' }}</Link
                                    >
                                </li>
                                <li>
                                    <Link href="/blog">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="16"
                                            height="17"
                                            viewBox="0 0 16 17"
                                            fill="none"
                                        >
                                            <path
                                                d="M14.526 1.4866L14.9194 1.87994C15.4614 2.4226 15.3794 3.3846 14.7347 4.0286L6.62337 12.1399L3.99537 13.1013C3.66537 13.2226 3.34404 13.0653 3.2787 12.7513C3.25669 12.6374 3.26709 12.5196 3.3087 12.4113L4.2887 9.7606L12.3774 1.67127C13.022 1.02727 13.984 0.943935 14.526 1.4866ZM6.26937 2.29327C6.35692 2.29327 6.44361 2.31051 6.52449 2.34402C6.60537 2.37752 6.67887 2.42663 6.74077 2.48853C6.80268 2.55044 6.85178 2.62393 6.88529 2.70481C6.91879 2.7857 6.93603 2.87239 6.93603 2.95994C6.93603 3.04748 6.91879 3.13417 6.88529 3.21506C6.85178 3.29594 6.80268 3.36943 6.74077 3.43134C6.67887 3.49325 6.60537 3.54235 6.52449 3.57586C6.44361 3.60936 6.35692 3.6266 6.26937 3.6266H3.6027C3.24908 3.6266 2.90994 3.76708 2.65989 4.01713C2.40984 4.26717 2.26937 4.60631 2.26937 4.95994V12.9599C2.26937 13.3136 2.40984 13.6527 2.65989 13.9027C2.90994 14.1528 3.24908 14.2933 3.6027 14.2933H11.6027C11.9563 14.2933 12.2955 14.1528 12.5455 13.9027C12.7956 13.6527 12.936 13.3136 12.936 12.9599V10.2933C12.936 10.1165 13.0063 9.94689 13.1313 9.82187C13.2563 9.69684 13.4259 9.6266 13.6027 9.6266C13.7795 9.6266 13.9491 9.69684 14.0741 9.82187C14.1991 9.94689 14.2694 10.1165 14.2694 10.2933V12.9599C14.2694 13.6672 13.9884 14.3455 13.4883 14.8456C12.9882 15.3457 12.3099 15.6266 11.6027 15.6266H3.6027C2.89546 15.6266 2.21718 15.3457 1.71708 14.8456C1.21699 14.3455 0.936035 13.6672 0.936035 12.9599V4.95994C0.936035 4.25269 1.21699 3.57441 1.71708 3.07432C2.21718 2.57422 2.89546 2.29327 3.6027 2.29327H6.26937Z"
                                                fill="currentColor"
                                            />
                                        </svg>
                                        {{ locale === 'en' ? 'Blogs' : 'ব্লগ' }}
                                    </Link>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <Link href="/contact">
                                {{ locale === 'en' ? 'Contact Us' : 'যোগাযোগ' }}
                            </Link>
                        </li>
                    </ul>


                    <div v-if="auth && auth.role === 'user'">
                        <a @click="redirectToDashboard" class="theme-btn">
                            <span v-if="locale === 'en'"> {{ auth.name }}</span>
                            <span v-else> {{ auth.name_bn }}</span>
                        </a>
                        <a href="/company-registration-start" class="theme-btn"
                        >{{ locale === 'en' ? 'Company ' : 'কোম্পানি' }}</a
                        >
                    </div>
                    <div v-else>
                        <a href="/login" class="theme-btn"
                        >{{ locale === 'en' ? 'SignUp / SignIn' : 'লগইন/রেজিস্ট্রেশন' }}</a
                        >
                        <a href="/company-registration-start" class="theme-btn"
                        >{{ locale === 'en' ? 'Company ' : 'কোম্পানি' }}</a
                        >
                    </div>


                </nav>
            </div>
        </div>
    </div>
</template>
<style scoped>

</style>





