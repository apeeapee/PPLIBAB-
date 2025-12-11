@php
    $title = 'Daftar Sebagai Penjual | kampuStore';
@endphp
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>

    {{-- Icon Unicons --}}
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box
        }

        /* ===================== THEME VARIABLES ===================== */
        :root {
            --bg-body: #050b1f;
            --text-main: #e5e7eb;

            --nav-bg: linear-gradient(90deg, #020617, #020617);
            --nav-border-bottom: rgba(30, 64, 175, 0.5);
            --nav-shadow: 0 14px 40px rgba(15, 23, 42, 0.9);
            --nav-link-color: #e5e7eb;

            --market-bg: radial-gradient(circle at top left, #1f3b8a 0, #020617 52%, #020617 100%);

            --page-title-color: #f9fafb;
            --breadcrumb-color: #9ca3af;

            --reset-btn-bg: #020617;
            --reset-btn-border: #1f2937;

            --toast-bg: #020617;

            --accent-input: #f97316;
            --accent-input-soft: rgba(249, 115, 22, 0.32);
        }

        body.theme-light {
            --bg-body: #eef2ff;
            --text-main: #1a2550;

            --nav-bg: #ffffff;
            --nav-border-bottom: #d9ddf0;
            --nav-shadow: 0 4px 12px rgba(20, 30, 60, 0.08);
            --nav-link-color: #1a2450;

            --market-bg: linear-gradient(135deg,
                    #ffffff 0%,
                    #e3e8ff 40%,
                    #d5ddff 100%);

            --page-title-color: #1a2450;
            --breadcrumb-color: #6b76a5;

            --reset-btn-bg: #e3e6ff;
            --reset-btn-border: #c5cdf5;

            --toast-bg: #1b2652;

            --accent-input: #ea580c;
            --accent-input-soft: rgba(234, 88, 12, 0.35);
        }

        /* ===================== GLOBAL ===================== */
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Arial, sans-serif;
            background: var(--bg-body);
            color: var(--text-main);
            min-height: 100vh;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* ===================== NAVBAR ===================== */
        .nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 50;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 60px;
            background: var(--nav-bg);
            border-bottom: 1px solid var(--nav-border-bottom);
            box-shadow: var(--nav-shadow);
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 28px;
        }

        .nav-logo {
            display: flex;
            align-items: center;
            font-weight: 700;
            font-size: 22px;
            letter-spacing: 0.04em;
            color: #f9fafb;
            cursor: pointer;
        }

        .nav-logo img {
            height: 40px;
            display: block;
        }

        body.theme-light .nav-logo {
            color: #111827;
        }

        .nav-logo:hover {
            opacity: .85;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 28px;
            font-size: 14px;
        }

        .nav-menu a {
            color: var(--nav-link-color);
            position: relative;
        }

        .nav-menu a::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -4px;
            height: 2px;
            width: 100%;
            background: #f97316;
            border-radius: 999px;
            transform: scaleX(0);
            transform-origin: left;
            opacity: 0;
            transition: transform .25s ease-out, opacity .2s ease-out;
        }

        .nav-menu a:hover {
            color: #f97316;
        }

        .nav-menu a:hover::after {
            transform: scaleX(1);
            opacity: 1;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* ===================== THEME TOGGLE ===================== */
        .theme-toggle-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 74px;
            height: 36px;
            transform: scale(.95);
            transition: transform .2s;
        }

        .toggle-switch:hover {
            transform: scale(1);
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            inset: 0;
            background: linear-gradient(145deg, #fbbf24, #f97316);
            transition: .4s;
            border-radius: 34px;
            box-shadow: 0 0 12px rgba(249, 115, 22, 0.5);
            overflow: hidden;
        }

        .slider:before {
            position: absolute;
            content: "☀";
            height: 28px;
            width: 28px;
            left: 4px;
            bottom: 4px;
            background: white;
            transition: .4s;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            z-index: 2;
        }

        .clouds {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }

        .cloud {
            position: absolute;
            width: 24px;
            height: 24px;
            fill: rgba(255, 255, 255, 0.9);
            filter: drop-shadow(0 2px 3px rgba(0, 0, 0, 0.08));
        }

        .cloud1 {
            top: 6px;
            left: 10px;
            animation: floatCloud1 8s infinite linear;
        }

        .cloud2 {
            top: 10px;
            left: 38px;
            transform: scale(.85);
            animation: floatCloud2 12s infinite linear;
        }

        @keyframes floatCloud1 {
            0% {
                transform: translateX(-20px);
                opacity: 0;
            }

            20% {
                opacity: 1;
            }

            80% {
                opacity: 1;
            }

            100% {
                transform: translateX(80px);
                opacity: 0;
            }
        }

        @keyframes floatCloud2 {
            0% {
                transform: translateX(-20px) scale(.85);
                opacity: 0;
            }

            20% {
                opacity: .7;
            }

            80% {
                opacity: .7;
            }

            100% {
                transform: translateX(80px) scale(.85);
                opacity: 0;
            }
        }

        input.js-theme-toggle:checked+.slider {
            background: linear-gradient(145deg, #1f2937, #020617);
            box-shadow: 0 0 14px rgba(15, 23, 42, 0.8);
        }

        input.js-theme-toggle:checked+.slider:before {
            transform: translateX(38px);
            content: "🌙";
        }

        input.js-theme-toggle:checked+.slider .cloud {
            opacity: 0;
            transform: translateY(-18px);
        }

        /* ===================== AUTH BACKGROUND ===================== */
        .auth-bg {
            min-height: 100vh;
            padding: 120px 40px 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--market-bg);
            position: relative;
            overflow: hidden;
        }

        .auth-bg::before,
        .auth-bg::after {
            content: '';
            position: absolute;
            border-radius: 999px;
            filter: blur(26px);
            opacity: .55;
        }

        .auth-bg::before {
            width: 360px;
            height: 360px;
            background: linear-gradient(135deg, #6366f1, #f97316);
            top: -130px;
            left: -80px;
        }

        .auth-bg::after {
            width: 320px;
            height: 320px;
            background: linear-gradient(135deg, #0ea5e9, #22c55e);
            bottom: -150px;
            right: -70px;
        }

        body.theme-light .auth-bg::before,
        body.theme-light .auth-bg::after {
            opacity: .2;
        }

        /* ===================== SHELL ===================== */
        .auth-shell {
            width: 100%;
            max-width: 1100px;
            min-height: 520px;
            border-radius: 28px;
            overflow: hidden;
            background: linear-gradient(135deg,
                    rgba(15, 23, 42, 0.74),
                    rgba(15, 23, 42, 0.94));
            border: 1px solid rgba(59, 130, 246, 0.45);
            box-shadow: 0 22px 60px rgba(0, 0, 0, .9);
            display: flex;
            position: relative;
            z-index: 1;
            backdrop-filter: blur(18px);
        }

        body.theme-light .auth-shell {
            background: linear-gradient(135deg,
                    rgba(255, 255, 255, 0.88),
                    rgba(239, 246, 255, 0.98));
            border: 1px solid rgba(148, 163, 184, 0.6);
            box-shadow: 0 20px 50px rgba(148, 163, 184, 0.65);
        }

        .auth-panel,
        .auth-visual {
            transition:
                transform .6s cubic-bezier(0.25, 0.8, 0.25, 1),
                opacity .6s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .auth-shell.pre-enter .auth-panel {
            transform: translate3d(60px, 0, 0);
            opacity: 0;
        }

        .auth-shell.pre-enter .auth-visual {
            transform: translate3d(-60px, 0, 0);
            opacity: 0;
        }

        .auth-shell.is-visible .auth-panel,
        .auth-shell.is-visible .auth-visual {
            transform: translate3d(0, 0, 0);
            opacity: 1;
        }

        /* ===================== VISUAL (KIRI) ===================== */
        .auth-visual {
            flex: 1.15;
            background: radial-gradient(circle at top, #1f3f90 0, #020617 55%, #020617 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 32px 28px;
            position: relative;
            overflow: hidden;
        }

        body.theme-light .auth-visual {
            background: radial-gradient(circle at top, #dbeafe 0, #93c5fd 45%, #60a5fa 100%);
        }

        .auth-visual::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 10% 10%, rgba(96, 165, 250, 0.18), transparent 55%),
                radial-gradient(circle at 90% 90%, rgba(248, 113, 22, 0.18), transparent 55%);
            opacity: .8;
            pointer-events: none;
        }

        .visual-card {
            position: relative;
            width: 100%;
            max-width: 480px;
            padding: 28px 34px;
            border-radius: 26px;
            background: radial-gradient(circle at 40% 40%,
                    rgba(255, 255, 255, 0.97) 0,
                    rgba(248, 250, 252, 0.92) 45%,
                    rgba(59, 130, 246, 0.45) 100%);
            backdrop-filter: blur(26px);
            border: 1px solid rgba(191, 219, 254, 0.95);
            box-shadow:
                0 20px 50px rgba(15, 23, 42, 0.65),
                0 0 40px rgba(96, 165, 250, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        body.theme-light .visual-card {
            background: radial-gradient(circle at 40% 40%,
                    rgba(255, 255, 255, 1) 0,
                    rgba(239, 246, 255, 0.98) 55%,
                    rgba(191, 219, 254, 0.85) 100%);
            border: 1px solid rgba(148, 163, 184, 0.8);
            box-shadow:
                0 18px 40px rgba(148, 163, 184, 0.65),
                0 0 30px rgba(129, 140, 248, 0.35);
        }

        .visual-card img {
            position: relative;
            max-width: 100%;
            height: auto;
            display: block;
            border-radius: 20px;
            filter: drop-shadow(0 12px 24px rgba(15, 23, 42, 0.35)) brightness(1.25)contrast(1.12);
        }

        /* ===================== PANEL FORM (KANAN) ===================== */
        .auth-panel {
            flex: 1.05;
            padding: 34px 46px 34px;
            display: flex;
            flex-direction: column;
            color: #f9fafb;
            background: linear-gradient(145deg,
                    rgba(23, 37, 84, 0.78),
                    rgba(15, 23, 42, 0.94),
                    rgba(30, 64, 175, 0.86));
            border-left: 1px solid rgba(148, 163, 184, 0.6);
            backdrop-filter: blur(26px);
            box-shadow:
                inset 0 0 0 1px rgba(30, 64, 175, 0.45),
                0 18px 45px rgba(0, 0, 0, 0.9),
                0 0 35px rgba(37, 99, 235, 0.35);
        }

        body.theme-light .auth-panel {
            background: linear-gradient(145deg,
                    rgba(255, 255, 255, 0.9),
                    rgba(239, 246, 255, 0.99));
            color: #111827;
            border-left: 1px solid rgba(191, 219, 254, 0.9);
            box-shadow:
                inset 0 0 0 1px rgba(255, 255, 255, 0.7),
                0 18px 40px rgba(148, 163, 184, 0.7);
        }

        .auth-panel-inner {
            max-width: 480px;
            margin: auto 0;
        }

        .auth-eyebrow {
            font-size: 12px;
            letter-spacing: .18em;
            text-transform: uppercase;
            color: #9ca3af;
            margin-bottom: 4px;
        }

        body.theme-light .auth-eyebrow {
            color: #6b7280;
        }

        .auth-title {
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 6px;
            color: var(--page-title-color);
        }

        .auth-subtitle {
            font-size: 14px;
            color: #9ca3af;
            margin-bottom: 18px;
        }

        body.theme-light .auth-subtitle {
            color: #6b7280;
        }

        .section-label {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .15em;
            color: #9ca3af;
            margin-top: 30px;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        body.theme-light .section-label {
            color: #6b7280;
        }

        .field-group {
            margin-bottom: 20px;
            width: 100%;
        }

        .field-row {
            display: flex;
            gap: 18px;
            margin-bottom: 14px;
        }

        .field-row .field-group {
            flex: 1;
            margin-bottom: 14px;
        }

        .field-select-row {
            display: flex;
            gap: 14px;
            margin-bottom: 14px;
        }

        .field-select-row .field-group {
            flex: 1;
            margin-bottom: 0;
        }

        .step-2 .field-group {
            margin-bottom: 10px;
        }

        .step-2 .field-select-row {
            margin-bottom: 10px;
        }

        .select-label {
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 6px;
            color: var(--text-main);
        }

        body.theme-light .select-label {
            color: #111827;
        }

        /* TEXTAREA PILL */
        .auth-textarea-box {
            width: 100%;
            padding: 10px 14px;
            border-radius: 18px;
            border: 1px solid rgba(148, 163, 184, 0.7);
            background: rgba(15, 23, 42, 0.6);
            color: #f9fafb;
            font-size: 14px;
            outline: none;
            resize: vertical;
            min-height: 72px;
        }

        .auth-textarea-box:focus {
            border-color: #f97316;
            box-shadow: 0 0 0 1px rgba(249, 115, 22, 0.35);
        }

        body.theme-light .auth-textarea-box {
            background: #ffffff;
            border-color: #cbd5e1;
            color: #111827;
        }

        /* SELECT PILL */
        .field-select {
            position: relative;
        }

        .auth-select-box {
            width: 100%;
            padding: 9px 36px 9px 12px;
            border-radius: 999px;
            border: 1px solid rgba(148, 163, 184, 0.7);
            background: rgba(15, 23, 42, 0.6);
            color: #f9fafb;
            font-size: 13px;
            outline: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        body.theme-light .auth-select-box {
            background: #ffffff;
            border-color: #cbd5e1;
            color: #111827;
        }

        .field-select::after {
            content: "▾";
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 11px;
            color: #9ca3af;
            pointer-events: none;
        }

        /* FILE INPUTS */
        .file-group {
            margin-bottom: 14px;
        }

        .file-label-main {
            font-size: 13px;
            font-weight: 500;
            color: var(--text-main);
            margin-bottom: 4px;
        }

        .file-input {
            width: 100%;
            padding: 8px 10px;
            font-size: 12px;
            border-radius: 999px;
            border: 1px solid rgba(148, 163, 184, 0.7);
            background: rgba(15, 23, 42, 0.7);
            color: var(--text-main);
        }

        body.theme-light .file-input {
            background: #ffffff;
            border-color: #cbd5e1;
            color: #111827;
        }

        .file-help {
            font-size: 10px;
            color: #9ca3af;
            margin-top: 4px;
        }

        body.theme-light .file-help {
            color: #6b7280;
        }

        /* STEP NAV */
        .step-nav {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 18px;
        }

        .step-pill {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 6px 12px;
            border-radius: 999px;
            background: rgba(15, 23, 42, 0.7);
            border: 1px solid rgba(148, 163, 184, 0.6);
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .12em;
            color: #9ca3af;
        }

        .step-pill-number {
            width: 20px;
            height: 20px;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 11px;
            background: #111827;
            color: #f9fafb;
        }

        .step-pill--active {
            border-color: #f97316;
            color: #f97316;
        }

        .step-pill--active .step-pill-number {
            background: #f97316;
            color: #111827;
        }

        .step-line {
            flex: 1;
            height: 2px;
            margin: 0 10px;
            border-radius: 999px;
            background: rgba(148, 163, 184, 0.45);
        }

        /* === LIGHT MODE OVERRIDES === */
        body.theme-light .step-pill {
            background: #ffffff;
            border-color: #e5e7eb;
            color: #475569;
        }

        body.theme-light .step-pill-number {
            background: #e5e7eb;
            color: #111827;
            border: 1px solid #cbd5e1;
        }

        body.theme-light .step-pill--active {
            border-color: #f97316;
            background: #fff7ed;
            color: #c2410c;
            box-shadow: 0 2px 6px rgba(249, 115, 22, 0.25);
        }

        body.theme-light .step-pill--active .step-pill-number {
            background: #f97316;
            color: #ffffff;
            border-color: #f97316;
        }

        body.theme-light .step-line {
            height: 2px;
            background: #e5e7eb;
            opacity: 0.9;
        }

        /* Step visibility */
        .step {
            display: none;
        }

        .step--active {
            display: block;
        }

        /* BUTTONS */
        .step-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin-top: 18px;
        }

        .btn-secondary {
            border-radius: 999px;
            padding: 9px 18px;
            font-size: 13px;
            border: 1px solid rgba(148, 163, 184, 0.7);
            background: rgba(15, 23, 42, 0.6);
            color: var(--text-main);
            cursor: pointer;
            transition:
                background .2s ease,
                border-color .2s ease,
                box-shadow .18s ease,
                transform .18s ease;
        }

        .btn-secondary:hover,
        .btn-secondary:focus-visible {
            border-color: var(--accent-input);
            background: rgba(15, 23, 42, 0.9);
            box-shadow: 0 8px 18px var(--accent-input-soft);
            transform: translateY(-1px);
        }

        .btn-secondary:active {
            transform: translateY(0);
            box-shadow: 0 4px 10px var(--accent-input-soft);
        }

        body.theme-light .btn-secondary {
            background: #e5e7eb;
            border-color: #cbd5e1;
            color: #111827;
        }

        body.theme-light .btn-secondary:hover,
        body.theme-light .btn-secondary:focus-visible {
            border-color: var(--accent-input);
            background: #f3f4ff;
            box-shadow: 0 8px 18px var(--accent-input-soft);
        }

        .btn-secondary[disabled] {
            opacity: .4;
            cursor: default;
            transform: none;
            box-shadow: none;
        }

        /* PRIMARY BUTTON TETAP */
        .auth-btn-primary {
            width: 100%;
            border: none;
            border-radius: 999px;
            padding: 11px 18px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            background: #f97316;
            color: #111827;
            margin-top: 8px;
            transition: background .2s ease, transform .15s ease, box-shadow .15s ease;
            box-shadow: 0 12px 25px rgba(248, 113, 22, .45);
        }

        .auth-btn-primary:hover {
            background: #fb923c;
            transform: translateY(-1px);
        }

        .auth-btn-primary:active {
            transform: translateY(0);
            box-shadow: 0 6px 16px rgba(248, 113, 22, .5);
        }

        .auth-bottom-text {
            margin-top: 14px;
            font-size: 13px;
            text-align: center;
            color: var(--text-main);
        }

        .auth-bottom-text a {
            color: #f97316;
            font-weight: 600;
        }

        /* ALERTS & ERROR */
        .auth-error {
            font-size: 12px;
            color: #fecaca;
            margin-top: 4px;
        }

        .auth-global-error {
            background: rgba(185, 28, 28, 0.18);
            border: 1px solid rgba(248, 113, 113, 0.6);
            color: #fecaca;
            border-radius: 10px;
            padding: 8px 10px;
            font-size: 12px;
            margin-bottom: 14px;
        }

        .alert-info,
        .alert-error {
            border-radius: 14px;
            padding: 10px 12px;
            font-size: 13px;
            margin-bottom: 10px;
            display: flex;
            gap: 8px;
            align-items: flex-start;
        }

        .alert-info {
            background: rgba(59, 130, 246, 0.12);
            border: 1px solid rgba(59, 130, 246, 0.6);
            color: #e5edff;
        }

        body.theme-light .alert-info {
            background: #eff6ff;
            border-color: #bfdbfe;
            color: #1d4ed8;
        }

        .alert-error {
            background: rgba(220, 38, 38, 0.18);
            border: 1px solid rgba(248, 113, 113, 0.6);
            color: #fecaca;
        }

        body.theme-light .alert-error {
            background: #fef2f2;
            border-color: #fecaca;
            color: #b91c1c;
        }

        /* ============== FLOAT LABEL INPUT (UNTUK SEMUA INPUT) ============== */
        .float-group {
            position: relative;
            width: 100%;
            margin-top: 10px;
        }

        .float-input {
            width: 100%;
            padding: 10px 16px;
            border-radius: 999px;
            border: 1px solid rgba(148, 163, 184, 0.7);
            background: rgba(15, 23, 42, 0.75);
            color: var(--text-main);
            font-size: 14px;
            outline: none;
            transition: border-color .25s ease, box-shadow .25s ease;
        }

        body.theme-light .float-input {
            background: #ffffff;
            border-color: #cbd5e1;
            color: #111827;
        }

        /* Fokus → border & glow ikut warna accent theme */
        .float-input:focus {
            border-color: var(--accent-input);
            box-shadow: 0 0 0 2px var(--accent-input-soft);
        }

        /* Label default di tengah (kayak placeholder) */
        .float-label {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 13px;
            color: #9ca3af;
            pointer-events: none;
            transition: all .2s ease;
        }

        body.theme-light .float-label {
            color: #6b7280;
        }

        .float-input:focus+.float-label,
        .float-input:not(:placeholder-shown)+.float-label {
            top: -18px;
            transform: none;
            font-size: 11px;
            color: var(--accent-input);
            background: transparent;
        }

        /* ===================== RESPONSIVE ===================== */
        @media(max-width:900px) {
            .nav {
                padding: 14px 18px;
            }

            .nav-left {
                gap: 18px;
            }

            .nav-menu {
                gap: 18px;
                font-size: 13px;
            }

            .auth-bg {
                padding: 110px 18px 40px;
            }

            .auth-shell {
                max-width: 520px;
                flex-direction: column;
                border-radius: 24px;
            }

            .auth-panel {
                padding: 26px 22px 24px;
            }

            .auth-panel-inner {
                max-width: 100%;
            }

            .auth-visual {
                padding: 12px 16px 18px;
            }

            .visual-card {
                max-width: 100%;
            }

            .visual-card img {
                border-radius: 20px;
            }
        }
    </style>
</head>

<body class="theme-dark">

    <nav class="nav">
        <div class="nav-left">
            <a href="{{ route('home') }}" class="nav-logo">
                <img src="{{ asset('images/logo.png') }}" alt="kampuStore logo">
                <span>kampuStore</span>
            </a>

            <div class="nav-menu">
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('home') }}#features">Features</a>
                <a href="{{ route('products.index') }}">Market</a>
                <a href="{{ route('home') }}#about">About</a>
                <a href="{{ route('home') }}#contact">Contact</a>
            </div>
        </div>

        <div class="nav-actions">
            {{-- theme toggle kamu di sini --}}
        </div>

        <div class="nav-actions">
            <div class="theme-toggle-wrapper">
                <label class="toggle-switch">
                    <input type="checkbox" class="js-theme-toggle" />
                    <span class="slider">
                        <div class="clouds">
                            <svg viewBox="0 0 100 100" class="cloud cloud1">
                                <path
                                    d="M30,45 Q35,25 50,25 Q65,25 70,45 Q80,45 85,50 Q90,55 85,60 Q80,65 75,60 Q65,60 60,65 Q55,70 50,65 Q45,70 40,65 Q35,60 25,60 Q20,65 15,60 Q10,55 15,50 Q20,45 30,45">
                                </path>
                            </svg>
                            <svg viewBox="0 0 100 100" class="cloud cloud2">
                                <path
                                    d="M30,45 Q35,25 50,25 Q65,25 70,45 Q80,45 85,50 Q90,55 85,60 Q80,65 75,60 Q65,60 60,65 Q55,70 50,65 Q45,70 40,65 Q35,60 25,60 Q20,65 15,60 Q10,55 15,50 Q20,45 30,45">
                                </path>
                            </svg>
                        </div>
                    </span>
                </label>
            </div>
        </div>
    </nav>

    <main class="auth-bg">
        <div class="auth-shell pre-enter">

            {{-- KIRI: kartu logo --}}
            <div class="auth-visual">
                <div class="visual-card">
                    <img src="{{ asset('images/pc.png') }}" alt="kampuStore hero">
                </div>
            </div>

            {{-- KANAN: form multi-step --}}
            <div class="auth-panel">
                <div class="auth-panel-inner">
                    <div class="auth-eyebrow">SELLER REGISTRATION</div>
                    <h1 class="auth-title">Buka Toko di kampuStore</h1>
                    <p class="auth-subtitle">
                        Lengkapi data toko, akun, dan alamatmu. Pengajuan akan diperiksa admin sebelum toko aktif.
                    </p>

                    {{-- pesan global --}}
                    @if(session('error'))
                        <div class="alert-error">
                            <strong>{{ session('error') }}</strong>
                        </div>
                    @endif

                    @if(session('info'))
                        <div class="alert-info">
                            <div>
                                <strong>Info:</strong><br>
                                <span>{{ session('info') }}</span>
                            </div>
                        </div>
                    @endif

                    <div class="alert-info">
                        <div>
                            <strong><i class="uil uil-info-circle"></i>Untuk pembeli:</strong><br>
                            Jika kamu hanya ingin berbelanja, tidak perlu registrasi atau login.
                            Silakan langsung ke
                            <a href="{{ route('products.index') }}" style="color:#f97316;font-weight:600;">halaman
                                market</a>.
                            Form ini khusus untuk penjual yang ingin buka toko.
                        </div>
                    </div>

                    @if($errors->any())
                        <div class="auth-global-error">
                            Ada beberapa data yang belum tepat. Silakan dicek kembali formulir di bawah.
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" id="sellerForm">
                        @csrf

                        {{-- Step nav: 3 tahap --}}
                        <div class="step-nav">
                            <div class="step-pill step-pill--active" data-step="1">
                                <span class="step-pill-number">1</span>
                                <span class="step-pill-text">Toko & Akun</span>
                            </div>
                            <div class="step-line"></div>
                            <div class="step-pill" data-step="2">
                                <span class="step-pill-number">2</span>
                                <span class="step-pill-text">Alamat</span>
                            </div>
                            <div class="step-line"></div>
                            <div class="step-pill" data-step="3">
                                <span class="step-pill-number">3</span>
                                <span class="step-pill-text">Verifikasi</span>
                            </div>
                        </div>

                        {{-- ================== STEP 1 ================== --}}
                        <div class="step step-1 step--active">
                            <div class="section-label">Tahap 1 · Data Toko</div>

                            {{-- Nama Toko --}}
                            <div class="field-group">
                                <div class="float-group">
                                    <input id="nama_toko" type="text" name="nama_toko" class="float-input"
                                        value="{{ old('nama_toko') }}" placeholder=" " required>
                                    <label for="nama_toko" class="float-label">Nama Toko *</label>
                                </div>
                                @error('nama_toko')
                                    <div class="auth-error">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Deskripsi singkat --}}
                            <div class="field-group">
                                <label for="deskripsi_singkat" class="select-label">
                                    Deskripsi singkat toko
                                </label>
                                <textarea id="deskripsi_singkat" name="deskripsi_singkat" class="auth-textarea-box"
                                    required>{{ old('deskripsi_singkat') }}</textarea>
                                @error('deskripsi_singkat')
                                    <div class="auth-error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="section-label" style="margin-top:26px;">Data Pemilik Toko (PIC)</div>

                            {{-- Nama PIC & No HP --}}
                            <div class="field-row">
                                <div class="field-group">
                                    <div class="float-group">
                                        <input id="nama_pic" type="text" name="nama_pic" class="float-input"
                                            value="{{ old('nama_pic') }}" placeholder=" " required>
                                        <label for="nama_pic" class="float-label">Nama Lengkap PIC</label>
                                    </div>
                                    @error('nama_pic')
                                        <div class="auth-error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="field-group">
                                    <div class="float-group">
                                        <input id="no_hp_pic" type="text" name="no_hp_pic" class="float-input"
                                            value="{{ old('no_hp_pic') }}" placeholder=" " required>
                                        <label for="no_hp_pic" class="float-label">No HP / WhatsApp</label>
                                    </div>
                                    <div class="file-help">
                                        (Format: 08xxx) atau (+628xxx)
                                    </div>
                                    @error('no_hp_pic')
                                        <div class="auth-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Email & No KTP --}}
                            <div class="field-row">
                                <div class="field-group">
                                    <div class="float-group">
                                        <input id="email_pic" type="email" name="email_pic" class="float-input"
                                            value="{{ old('email_pic') }}" placeholder=" " required>
                                        <label for="email_pic" class="float-label">Email</label>
                                    </div>
                                    <div class="file-help">
                                        Email untuk login ke akun toko kamu.
                                    </div>
                                    @error('email_pic')
                                        <div class="auth-error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="field-group">
                                    <div class="float-group">
                                        <input id="no_ktp_pic" type="text" name="no_ktp_pic" class="float-input"
                                            value="{{ old('no_ktp_pic') }}" maxlength="16" pattern="[0-9]{16}"
                                            inputmode="numeric" placeholder=" " required>
                                        <label for="no_ktp_pic" class="float-label">No KTP </label>
                                    </div>
                                    <div class="file-help">
                                        Masukkan 16 digit angka.
                                    </div>
                                    @error('no_ktp_pic')
                                        <div class="auth-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Password & Konfirmasi --}}
                            <div class="field-row">
                                <div class="field-group">
                                    <div class="float-group">
                                        <input id="password" type="password" name="password" class="float-input"
                                            placeholder=" " required>
                                        <label for="password" class="float-label">Password </label>
                                    </div>
                                    <div class="file-help">
                                        Minimal 8 karakter.
                                    </div>
                                    @error('password')
                                        <div class="auth-error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="field-group">
                                    <div class="float-group">
                                        <input id="password_confirmation" type="password" name="password_confirmation"
                                            class="float-input" placeholder=" " required>
                                        <label for="password_confirmation" class="float-label">Konfirmasi
                                            Password</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ================== STEP 2 ================== --}}
                        <div class="step step-2">
                            <div class="section-label">Tahap 2 · Alamat Lengkap</div>

                            {{-- Alamat jalan --}}
                            <div class="field-group">
                                <div class="float-group">
                                    <input id="alamat_pic" type="text" name="alamat_pic" class="float-input"
                                        value="{{ old('alamat_pic') }}" placeholder=" " required>
                                    <label for="alamat_pic" class="float-label">
                                        Alamat (Nama Jalan, No. Rumah) *
                                    </label>
                                </div>
                                @error('alamat_pic')
                                    <div class="auth-error">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Provinsi & Kota --}}
                            <div class="field-select-row">
                                <div class="field-group">
                                    <label for="provinsi" class="select-label">Provinsi *</label>
                                    <div class="field-select">
                                        <select id="provinsi" name="provinsi" class="auth-select-box" required>
                                            <option value="">Pilih Provinsi</option>
                                            {{-- diisi via JS --}}
                                        </select>
                                    </div>
                                    @error('provinsi')
                                        <div class="auth-error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="field-group">
                                    <label for="kota" class="select-label">Kota / Kabupaten *</label>
                                    <div class="field-select">
                                        <select id="kota" name="kota" class="auth-select-box" required>
                                            <option value="">Pilih kota/kabupaten</option>
                                        </select>
                                    </div>
                                    @error('kota')
                                        <div class="auth-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Kelurahan --}}
                            <div class="field-group">
                                <label for="kelurahan" class="select-label">Kelurahan / Desa *</label>
                                <div class="field-select">
                                    <select id="kelurahan" name="kelurahan" class="auth-select-box" required>
                                        <option value="">Pilih kelurahan/desa</option>
                                    </select>
                                </div>
                                @error('kelurahan')
                                    <div class="auth-error">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- RT / RW --}}
                            <div class="field-select-row">
                                <div class="field-group">
                                    <div class="float-group">
                                        <input id="rt" type="text" name="rt" class="float-input" value="{{ old('rt') }}"
                                            placeholder=" " required>
                                        <label for="rt" class="float-label">RT</label>
                                    </div>
                                    @error('rt')
                                        <div class="auth-error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="field-group">
                                    <div class="float-group">
                                        <input id="rw" type="text" name="rw" class="float-input" value="{{ old('rw') }}"
                                            placeholder=" " required>
                                        <label for="rw" class="float-label">RW</label>
                                    </div>
                                    @error('rw')
                                        <div class="auth-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- ================== STEP 3 ================== --}}
                        <div class="step step-3">
                            <div class="section-label">Tahap 3 · Dokumen Verifikasi</div>

                            <div class="file-group">
                                <div class="file-label-main">Foto Anda (Selfie) *</div>
                                <input type="file" name="foto_pic" class="file-input" required
                                    accept="image/jpeg,image/jpg,image/png">
                                <div class="file-help">
                                    Foto wajah jelas. Format JPG/JPEG/PNG, maks 2 MB.
                                </div>
                                @error('foto_pic')
                                    <div class="auth-error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="file-group">
                                <div class="file-label-main">File Scan KTP *</div>
                                <input type="file" name="file_ktp_pic" class="file-input" required
                                    accept="application/pdf,image/jpeg,image/jpg,image/png">
                                <div class="file-help">
                                    Scan/foto KTP yang jelas. Format PDF/JPG/JPEG/PNG, maks 4 MB.
                                </div>
                                @error('file_ktp_pic')
                                    <div class="auth-error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- BUTTONS --}}
                        <div class="step-actions">
                            <button type="button" class="btn-secondary" id="btnPrev">Kembali</button>
                            <button type="button" class="btn-secondary" id="btnNext">Lanjut</button>
                            <button type="submit" class="auth-btn-primary" id="btnSubmit">
                                Kirim Pengajuan Buka Toko
                            </button>
                        </div>
                    </form>

                    <div class="auth-bottom-text">
                        Already have an account?
                        <a href="{{ route('login') }}" id="goLogin">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // ===== THEME TOGGLE =====
        (function () {
            const KEY = 'kampuStoreTheme';
            const body = document.body;
            const toggle = document.querySelector('.js-theme-toggle');

            function apply(mode) {
                if (mode === 'light') {
                    body.classList.add('theme-light');
                } else {
                    body.classList.remove('theme-light');
                }
            }

            const saved = localStorage.getItem(KEY) || 'dark';
            apply(saved);

            if (toggle) {
                toggle.checked = (saved !== 'light');
                toggle.addEventListener('change', () => {
                    const mode = toggle.checked ? 'dark' : 'light';
                    apply(mode);
                    localStorage.setItem(KEY, mode);
                });
            }
        })();

        // ===== ANIMASI SHELL + MULTI STEP =====
        document.addEventListener('DOMContentLoaded', function () {
            const shell = document.querySelector('.auth-shell');
            if (shell) {
                requestAnimationFrame(() => {
                    shell.classList.remove('pre-enter');
                    shell.classList.add('is-visible');
                });
            }

            const steps = document.querySelectorAll('.step');
            const pills = document.querySelectorAll('.step-pill');
            const btnPrev = document.getElementById('btnPrev');
            const btnNext = document.getElementById('btnNext');
            const btnSubmit = document.getElementById('btnSubmit');

            let currentStep = 1;

            function setStep(step) {
                currentStep = step;
                steps.forEach((s, idx) => {
                    s.classList.toggle('step--active', idx === step - 1);
                });
                pills.forEach(p => {
                    p.classList.toggle('step-pill--active', Number(p.dataset.step) === step);
                });

                btnPrev.disabled = (step === 1);
                btnNext.style.display = (step < 3) ? 'inline-block' : 'none';
                btnSubmit.style.display = (step === 3) ? 'inline-block' : 'none';
            }

            function validateStep1() {
                const requiredNames = [
                    'nama_toko', 'deskripsi_singkat',
                    'nama_pic', 'no_hp_pic', 'email_pic', 'no_ktp_pic',
                    'password', 'password_confirmation'
                ];
                for (const name of requiredNames) {
                    const el = document.querySelector('[name="' + name + '"]');
                    if (!el) continue;
                    if (!el.value || el.value.trim() === '') {
                        el.focus();
                        return false;
                    }
                }
                return true;
            }

            function validateStep2() {
                const requiredNames = [
                    'alamat_pic', 'provinsi', 'kota', 'kelurahan',
                    'rt', 'rw'
                ];
                for (const name of requiredNames) {
                    const el = document.querySelector('[name="' + name + '"]');
                    if (!el) continue;
                    if (!el.value || el.value.trim() === '') {
                        el.focus();
                        return false;
                    }
                }
                return true;
            }

            btnPrev.addEventListener('click', () => {
                if (currentStep > 1) {
                    setStep(currentStep - 1);
                }
            });

            btnNext.addEventListener('click', () => {
                if (currentStep === 1) {
                    if (!validateStep1()) return;
                    setStep(2);
                } else if (currentStep === 2) {
                    if (!validateStep2()) return;
                    setStep(3);
                }
            });

            setStep(1);
        });
    </script>

    <script>
        document.getElementById('no_ktp_pic').addEventListener('input', function () {
            this.value = this.value.replace(/\D/g, "");

            if (this.value.length > 16) {
                this.value = this.value.slice(0, 16);
            }
        });
    </script>

    <script>
        const API_BASE = 'https://www.emsifa.com/api-wilayah-indonesia/api';

        const dataCache = {
            provinces: null,
            regencies: {},
            districts: {},
            villages: {}
        };

        async function fetchWilayahData(url) {
            try {
                const response = await fetch(url);
                if (!response.ok) throw new Error('Network response was not ok');
                return await response.json();
            } catch (error) {
                console.error('Error fetching data:', error);
                return [];
            }
        }

        // Fallback (jika mau, isi sendiri data hardcoded)
        const wilayahData = {};

        const provinsiSelect = document.getElementById('provinsi');
        const kotaSelect = document.getElementById('kota');
        const kelurahanSelect = document.getElementById('kelurahan');

        const oldProvinsi = "{{ old('provinsi') }}";
        const oldKota = "{{ old('kota') }}";
        const oldKelurahan = "{{ old('kelurahan') }}";

        function setLoading(selectElement, isLoading) {
            if (isLoading) {
                selectElement.innerHTML = '<option value="">Loading...</option>';
                selectElement.disabled = true;
            } else {
                selectElement.disabled = false;
            }
        }

        async function loadProvinsi() {
            if (dataCache.provinces) {
                populateProvinsiDropdown(dataCache.provinces);
                return;
            }

            try {
                const provinces = await fetchWilayahData(`${API_BASE}/provinces.json`);
                dataCache.provinces = provinces;
                populateProvinsiDropdown(provinces);
            } catch (error) {
                console.error('Gagal load provinsi, fallback');
                const provinsiList = Object.keys(wilayahData || {});
                provinsiSelect.innerHTML = '<option value="">Pilih Provinsi</option>';
                provinsiList.forEach(prov => {
                    const option = document.createElement('option');
                    option.value = prov;
                    option.textContent = prov;
                    provinsiSelect.appendChild(option);
                });
            }
        }

        function populateProvinsiDropdown(provinces) {
            provinsiSelect.innerHTML = '<option value="">Pilih Provinsi</option>';
            provinces.forEach(prov => {
                const option = document.createElement('option');
                option.value = prov.name;
                option.textContent = prov.name;
                option.dataset.id = prov.id;
                provinsiSelect.appendChild(option);
            });
        }

        // event provinsi
        provinsiSelect.addEventListener('change', async function () {
            const selectedProvinsiId = this.options[this.selectedIndex]?.dataset?.id;
            const selectedProvinsiName = this.value;

            kotaSelect.innerHTML = '<option value="">Pilih kota/kabupaten</option>';
            kelurahanSelect.innerHTML = '<option value="">Pilih kelurahan/desa</option>';

            if (!selectedProvinsiId) return;

            if (dataCache.regencies[selectedProvinsiId]) {
                populateKotaDropdown(dataCache.regencies[selectedProvinsiId]);
                return;
            }

            setLoading(kotaSelect, true);
            try {
                const regencies = await fetchWilayahData(`${API_BASE}/regencies/${selectedProvinsiId}.json`);
                dataCache.regencies[selectedProvinsiId] = regencies;
                populateKotaDropdown(regencies);
            } catch (error) {
                console.error('Gagal load kota');
                if (wilayahData[selectedProvinsiName]) {
                    const kotaList = Object.keys(wilayahData[selectedProvinsiName]);
                    kotaSelect.innerHTML = '<option value="">Pilih kota/kabupaten</option>';
                    kotaList.forEach(kota => {
                        const option = document.createElement('option');
                        option.value = kota;
                        option.textContent = kota;
                        kotaSelect.appendChild(option);
                    });
                }
            } finally {
                setLoading(kotaSelect, false);
            }
        });

        function populateKotaDropdown(regencies) {
            kotaSelect.innerHTML = '<option value="">Pilih kota/kabupaten</option>';
            regencies.forEach(reg => {
                const option = document.createElement('option');
                option.value = reg.name;
                option.textContent = reg.name;
                option.dataset.id = reg.id;
                kotaSelect.appendChild(option);
            });
        }

        // Kota change -> Load all kelurahan (via all kecamatan)
        kotaSelect.addEventListener('change', async function () {
            const selectedKotaId = this.options[this.selectedIndex]?.dataset?.id;
            kelurahanSelect.innerHTML = '<option value="">Pilih kelurahan/desa</option>';

            if (!selectedKotaId) return;

            // Check cache for this kota's kelurahan
            if (dataCache.villages[selectedKotaId]) {
                populateKelurahanDropdown(dataCache.villages[selectedKotaId]);
                return;
            }

            setLoading(kelurahanSelect, true);
            try {
                // Step 1: Get all kecamatan in this kota
                const districts = await fetchWilayahData(`${API_BASE}/districts/${selectedKotaId}.json`);

                // Step 2: Get all kelurahan from all kecamatan
                let allVillages = [];
                for (const district of districts) {
                    const villages = await fetchWilayahData(`${API_BASE}/villages/${district.id}.json`);
                    allVillages = allVillages.concat(villages);
                }

                // Sort by name
                allVillages.sort((a, b) => a.name.localeCompare(b.name));

                // Cache and populate
                dataCache.villages[selectedKotaId] = allVillages;
                populateKelurahanDropdown(allVillages);
            } catch (error) {
                console.error('Gagal load kelurahan:', error);
                kelurahanSelect.innerHTML = '<option value="">Data tidak tersedia</option>';
            } finally {
                setLoading(kelurahanSelect, false);
            }
        });

        function populateKelurahanDropdown(villages) {
            kelurahanSelect.innerHTML = '<option value="">Pilih kelurahan/desa</option>';
            villages.forEach(vill => {
                const option = document.createElement('option');
                option.value = vill.name;
                option.textContent = vill.name;
                kelurahanSelect.appendChild(option);
            });
        }

        window.addEventListener('DOMContentLoaded', async function () {
            await loadProvinsi();

            if (oldProvinsi) {
                provinsiSelect.value = oldProvinsi;
                provinsiSelect.dispatchEvent(new Event('change'));

                setTimeout(async () => {
                    if (oldKota) {
                        kotaSelect.value = oldKota;
                        kotaSelect.dispatchEvent(new Event('change'));

                        setTimeout(async () => {
                            if (oldKecamatan) {
                                kecamatanSelect.value = oldKecamatan;
                                kecamatanSelect.dispatchEvent(new Event('change'));

                                setTimeout(() => {
                                    if (oldKelurahan) {
                                        kelurahanSelect.value = oldKelurahan;
                                    }
                                }, 400);
                            }
                        }, 400);
                    }
                }, 400);
            }
        });
    </script>


</body>

</html>