# 🌿 Verdant Fields — PHP App with Automated Hostinger Deployment

A simple PHP landing page wired to a **CI/CD pipeline**. Every push to the `main` branch is **automatically deployed** to Hostinger shared hosting via FTP — no manual uploads, ever.

**🔗 Live site:** [https://palevioletred-opossum-368913.hostingersite.com](https://palevioletred-opossum-368913.hostingersite.com)

---

## 📋 Table of Contents

- [How It Works](#-how-it-works)
- [Tech Stack](#-tech-stack)
- [Prerequisites](#-prerequisites)
- [Getting Started](#-getting-started)
- [Making Changes & Deploying](#-making-changes--deploying)
- [GitHub Secrets Setup](#-github-secrets-setup)
- [The Deploy Workflow](#-the-deploy-workflow)
- [Project Structure](#-project-structure)
- [Troubleshooting](#-troubleshooting)

---

## ⚙️ How It Works

```
  ┌──────────┐     git push      ┌────────────┐    FTP deploy    ┌───────────────────┐
  │  Your    │ ───────────────▶  │  GitHub    │ ───────────────▶ │  Hostinger        │
  │  Laptop  │   (branch: main)  │  Actions   │   (auto, ~10s)   │  public_html/     │
  └──────────┘                   └────────────┘                  └───────────────────┘
                                                                  Live site updates 🎉
```

1. You edit code locally and run `git push`.
2. GitHub Actions detects the push to `main` and triggers the deploy workflow.
3. The workflow connects to Hostinger over FTPS and syncs your files.
4. The live site updates automatically — **no manual FTP uploads needed**.

---

## 🧰 Tech Stack

| Layer        | Technology                                          |
|--------------|-----------------------------------------------------|
| Language     | PHP                                                 |
| Hosting      | Hostinger (shared hosting)                          |
| CI/CD        | GitHub Actions                                      |
| Deploy tool  | [SamKirkland/FTP-Deploy-Action](https://github.com/SamKirkland/FTP-Deploy-Action) |
| Protocol     | FTPS (port 21)                                       |

---

## ✅ Prerequisites

Before you begin, make sure you have:

- [Git](https://git-scm.com/downloads) installed
- A code editor (e.g. [VS Code](https://code.visualstudio.com/))
- *(Optional, to preview locally)* [XAMPP](https://www.apachefriends.org/) or PHP installed
- Access to this GitHub repository
- Hostinger FTP credentials (for configuring secrets)

---

## 🚀 Getting Started

### 1. Clone the repository

```bash
git clone https://github.com/mayankjjoshi/php-app-devops.git
cd php-app-devops
```

### 2. (Optional) Run it locally

If you have XAMPP, copy the project into `htdocs` and open it in your browser:

```
http://localhost/php-app-devops/
```

Or use PHP's built-in server:

```bash
php -S localhost:8000
```

Then visit **http://localhost:8000**.

---

## ✏️ Making Changes & Deploying

This is the everyday workflow. **Editing and pushing is all you need — deployment is automatic.**

```bash
# 1. Make sure you have the latest code
git pull origin main

# 2. Edit your files (e.g. index.php)

# 3. Stage your changes
git add .

# 4. Commit with a clear message
git commit -m "Update landing page hero section"

# 5. Push to main — this triggers the auto-deploy
git push origin main
```

> ⚡ **That's it.** Within ~10 seconds, GitHub Actions deploys your changes to Hostinger and the [live site](https://palevioletred-opossum-368913.hostingersite.com) updates automatically.

### Watch the deployment

1. Go to the repo on GitHub → **Actions** tab
2. Click the latest **"Deploy to hostinger"** run
3. Watch it go green ✅ — then refresh the live site

---

## 🔐 GitHub Secrets Setup

The workflow reads FTP credentials from **GitHub Secrets** (never hard-code them).

Go to: **Repo → Settings → Secrets and variables → Actions → New repository secret**

Add these four secrets:

| Secret Name     | Value                                                            | Notes                          |
|-----------------|-----------------------------------------------------------------|--------------------------------|
| `FTP_SERVER`    | `145.79.58.248`                                                 | ⚠️ **Bare IP — no `ftp://`**   |
| `FTP_USERNAME`  | `u833676327.palevioletred-opossum-368913.hostingersite.com`     | Your Hostinger FTP username    |
| `FTP_PASSWORD`  | `••••••••`                                                       | Your Hostinger FTP password    |
| `FTP_PORT`      | `21`                                                            | Standard FTP/FTPS port         |

> 💡 Find these in **hPanel → Files → FTP Accounts**.

---

## 🔄 The Deploy Workflow

The pipeline is defined in [`.github/workflows/deploy.yml`](.github/workflows/deploy.yml):

```yaml
name: Deploy to hostinger
on:
  push:
    branches:
      - main
jobs:
  ftp-deploy:
    runs-on: ubuntu-latest
    steps:
      - name: checkout code
        uses: actions/checkout@v4

      - name: FTP Deploy
        uses: SamKirkland/FTP-Deploy-Action@v4.3.5
        with:
          server: ${{ secrets.FTP_SERVER }}
          username: ${{ secrets.FTP_USERNAME }}
          password: ${{ secrets.FTP_PASSWORD }}
          port: ${{ secrets.FTP_PORT }}
          protocol: ftps
          local-dir: ./
          server-dir: ./
```

**Key details:**

- **Trigger:** runs on every push to `main`.
- **`server-dir: ./`** — Hostinger's FTP login already lands *inside* `public_html`, so we deploy to the root (using `public_html/` would create a broken nested folder).
- **`protocol: ftps`** — Hostinger uses explicit FTPS over port 21.
- Only **changed files** are uploaded after the first sync (it tracks state in `.ftp-deploy-sync-state.json`).

---

## 📁 Project Structure

```
php-app-devops/
├── .github/
│   └── workflows/
│       └── deploy.yml      # CI/CD pipeline (auto-deploy to Hostinger)
├── index.php               # The landing page
└── README.md               # You are here
```

---

## 🛠️ Troubleshooting

| Problem | Cause | Fix |
|---------|-------|-----|
| `composer.json not found` (exit 3) | A stray PHP Composer workflow | Remove unused `php.yml`; this project has no Composer deps |
| `Timeout (control socket)` | `FTP_SERVER` has an `ftp://` prefix | Set it to the **bare IP/host** only |
| Files land in `public_html/public_html/` | `server-dir` set to `public_html/` | Use `server-dir: ./` (login already starts in public_html) |
| Site shows old content | Browser cache | Hard-refresh (`Ctrl+Shift+R`) |
| Workflow not triggering | Pushed to a non-`main` branch | Push to `main`, or merge your branch into `main` |

---

## 📜 License

This project is provided as-is for educational and demonstration purposes.

---

<p align="center">
  Built with 🌱 &nbsp;•&nbsp; Auto-deployed via GitHub Actions → Hostinger
</p>
