<?php
// Simple agriculture landing page — single-file, no external dependencies.
$year = date('Y');
$company = 'Verdant Fields';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="<?php echo $company; ?> — sustainable farming, premium produce, and modern agricultural solutions grown with care." />
  <title><?php echo $company; ?> — Sustainable Agriculture &amp; Premium Produce</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <style>
    :root {
      --green-900: #14361f;
      --green-700: #1f6b3b;
      --green-600: #2a8a4d;
      --green-500: #3aa15f;
      --green-50:  #eef6f0;
      --sand:      #f7f4ec;
      --ink:       #1c2620;
      --muted:     #5d6b62;
      --line:      #e3e8e3;
      --white:     #ffffff;
      --radius:    16px;
      --shadow:    0 18px 40px -22px rgba(20, 54, 31, .35);
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }
    html { scroll-behavior: smooth; }
    body {
      font-family: 'Inter', system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
      color: var(--ink);
      background: var(--white);
      line-height: 1.6;
      -webkit-font-smoothing: antialiased;
    }
    h1, h2, h3 { font-family: 'DM Serif Display', Georgia, serif; font-weight: 400; line-height: 1.12; letter-spacing: -.01em; }
    a { color: inherit; text-decoration: none; }
    img { max-width: 100%; display: block; }

    .wrap { width: min(1120px, 92%); margin-inline: auto; }
    .btn {
      display: inline-flex; align-items: center; gap: .5rem;
      padding: .85rem 1.5rem; border-radius: 999px; font-weight: 600; font-size: .95rem;
      transition: transform .15s ease, box-shadow .15s ease, background .15s ease;
      cursor: pointer; border: none;
    }
    .btn-primary { background: var(--green-600); color: #fff; box-shadow: 0 10px 24px -12px rgba(42, 138, 77, .8); }
    .btn-primary:hover { background: var(--green-700); transform: translateY(-2px); }
    .btn-ghost { background: transparent; color: var(--green-900); border: 1.5px solid var(--line); }
    .btn-ghost:hover { border-color: var(--green-600); color: var(--green-700); }
    .eyebrow {
      display: inline-flex; align-items: center; gap: .5rem;
      font-size: .8rem; font-weight: 600; letter-spacing: .12em; text-transform: uppercase;
      color: var(--green-700); background: var(--green-50);
      padding: .4rem .9rem; border-radius: 999px;
    }

    /* Header */
    header {
      position: sticky; top: 0; z-index: 50;
      background: rgba(255,255,255,.86); backdrop-filter: blur(10px);
      border-bottom: 1px solid var(--line);
    }
    .nav { display: flex; align-items: center; justify-content: space-between; padding: 1.05rem 0; }
    .brand { display: flex; align-items: center; gap: .6rem; font-weight: 700; font-size: 1.15rem; color: var(--green-900); }
    .brand .leaf { width: 30px; height: 30px; display: grid; place-items: center; background: var(--green-600); color: #fff; border-radius: 9px; }
    .nav-links { display: flex; gap: 2rem; align-items: center; }
    .nav-links a { font-weight: 500; font-size: .95rem; color: var(--muted); transition: color .15s; }
    .nav-links a:hover { color: var(--green-700); }
    .nav-cta { display: flex; gap: .75rem; align-items: center; }

    /* Hero */
    .hero { background: linear-gradient(180deg, var(--sand), #fff); padding: clamp(3rem, 7vw, 6rem) 0 clamp(3rem, 6vw, 5rem); }
    .hero-grid { display: grid; grid-template-columns: 1.05fr .95fr; gap: clamp(2rem, 5vw, 4rem); align-items: center; }
    .hero h1 { font-size: clamp(2.5rem, 5.5vw, 4rem); color: var(--green-900); margin: 1.1rem 0 1.1rem; }
    .hero p { font-size: 1.12rem; color: var(--muted); max-width: 36ch; }
    .hero-actions { display: flex; gap: .9rem; margin-top: 1.8rem; flex-wrap: wrap; }
    .hero-stats { display: flex; gap: 2.2rem; margin-top: 2.6rem; flex-wrap: wrap; }
    .hero-stats .num { font-family: 'DM Serif Display', serif; font-size: 1.9rem; color: var(--green-700); }
    .hero-stats .lbl { font-size: .85rem; color: var(--muted); }
    .hero-art {
      position: relative; aspect-ratio: 4/5; border-radius: 24px; overflow: hidden;
      background:
        radial-gradient(120% 90% at 70% 10%, #6fc785 0%, transparent 55%),
        linear-gradient(160deg, var(--green-600), var(--green-900));
      box-shadow: var(--shadow);
    }
    .hero-art::after {
      content: ""; position: absolute; inset: 0;
      background-image:
        repeating-linear-gradient(115deg, rgba(255,255,255,.06) 0 2px, transparent 2px 26px);
    }
    .hero-art .badge {
      position: absolute; bottom: 1.2rem; left: 1.2rem; right: 1.2rem;
      background: rgba(255,255,255,.95); border-radius: 14px; padding: 1rem 1.2rem;
      display: flex; align-items: center; gap: .9rem; backdrop-filter: blur(6px);
    }
    .hero-art .badge .dot { width: 42px; height: 42px; border-radius: 12px; background: var(--green-50); display: grid; place-items: center; font-size: 1.3rem; }
    .hero-art .badge strong { display: block; font-size: .95rem; color: var(--green-900); }
    .hero-art .badge span { font-size: .82rem; color: var(--muted); }

    /* Trusted strip */
    .strip { border-block: 1px solid var(--line); background: #fff; }
    .strip .wrap { display: flex; align-items: center; gap: 2rem; padding: 1.3rem 0; flex-wrap: wrap; justify-content: center; }
    .strip span { font-weight: 600; color: #aab4ac; letter-spacing: .03em; font-size: .95rem; }

    /* Section */
    section { padding: clamp(3.5rem, 7vw, 6rem) 0; }
    .section-head { max-width: 640px; margin: 0 auto 3rem; text-align: center; }
    .section-head h2 { font-size: clamp(2rem, 4vw, 2.8rem); color: var(--green-900); margin: 1rem 0 .8rem; }
    .section-head p { color: var(--muted); font-size: 1.05rem; }

    /* Features */
    .cards { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.4rem; }
    .card {
      background: #fff; border: 1px solid var(--line); border-radius: var(--radius);
      padding: 1.8rem; transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease;
    }
    .card:hover { transform: translateY(-4px); box-shadow: var(--shadow); border-color: transparent; }
    .card .ic { width: 52px; height: 52px; border-radius: 14px; background: var(--green-50); color: var(--green-700); display: grid; place-items: center; font-size: 1.5rem; margin-bottom: 1.1rem; }
    .card h3 { font-size: 1.35rem; color: var(--green-900); margin-bottom: .5rem; }
    .card p { color: var(--muted); font-size: .97rem; }

    /* About / split */
    .split { display: grid; grid-template-columns: 1fr 1fr; gap: clamp(2rem, 5vw, 4rem); align-items: center; }
    .split .art {
      aspect-ratio: 5/4; border-radius: 24px;
      background:
        radial-gradient(90% 80% at 20% 20%, #98d8ab 0%, transparent 60%),
        linear-gradient(150deg, var(--green-500), var(--green-700));
      box-shadow: var(--shadow); position: relative; overflow: hidden;
    }
    .split .art::after { content: ""; position: absolute; inset: 0; background: repeating-linear-gradient(90deg, rgba(255,255,255,.05) 0 1px, transparent 1px 34px); }
    .split h2 { font-size: clamp(1.9rem, 3.6vw, 2.6rem); color: var(--green-900); margin: 1rem 0; }
    .split p { color: var(--muted); margin-bottom: 1rem; }
    .checklist { list-style: none; display: grid; gap: .8rem; margin-top: 1.4rem; }
    .checklist li { display: flex; gap: .7rem; align-items: flex-start; color: var(--ink); font-weight: 500; }
    .checklist .tick { color: var(--green-600); font-weight: 700; }

    /* Stats band */
    .band { background: var(--green-900); color: #fff; border-radius: 28px; padding: clamp(2.5rem, 5vw, 3.5rem); }
    .band-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; text-align: center; }
    .band .num { font-family: 'DM Serif Display', serif; font-size: clamp(2.2rem, 4vw, 3rem); color: #9be8b3; }
    .band .lbl { color: #c8d6cd; font-size: .92rem; }

    /* CTA */
    .cta { text-align: center; }
    .cta-box { background: linear-gradient(150deg, var(--green-50), #fff); border: 1px solid var(--line); border-radius: 28px; padding: clamp(2.5rem, 5vw, 4rem); }
    .cta-box h2 { font-size: clamp(2rem, 4vw, 2.9rem); color: var(--green-900); margin-bottom: .8rem; }
    .cta-box p { color: var(--muted); max-width: 48ch; margin: 0 auto 1.8rem; font-size: 1.05rem; }

    /* Footer */
    footer { background: var(--green-900); color: #c8d6cd; padding: 3.5rem 0 2rem; }
    .foot-grid { display: grid; grid-template-columns: 1.5fr 1fr 1fr 1fr; gap: 2rem; }
    footer .brand { color: #fff; margin-bottom: .8rem; }
    footer h4 { color: #fff; font-family: 'Inter', sans-serif; font-size: .95rem; margin-bottom: 1rem; letter-spacing: .03em; }
    footer ul { list-style: none; display: grid; gap: .6rem; }
    footer a { color: #c8d6cd; font-size: .94rem; transition: color .15s; }
    footer a:hover { color: #9be8b3; }
    .foot-bottom { border-top: 1px solid rgba(255,255,255,.12); margin-top: 2.5rem; padding-top: 1.5rem; display: flex; justify-content: space-between; flex-wrap: wrap; gap: 1rem; font-size: .88rem; color: #94a89c; }

    @media (max-width: 900px) {
      .hero-grid, .split { grid-template-columns: 1fr; }
      .hero-art { order: -1; aspect-ratio: 16/11; }
      .cards { grid-template-columns: 1fr; }
      .band-grid { grid-template-columns: repeat(2, 1fr); }
      .foot-grid { grid-template-columns: 1fr 1fr; }
      .nav-links { display: none; }
    }
    @media (max-width: 520px) {
      .band-grid { grid-template-columns: 1fr; }
      .foot-grid { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>

  <header>
    <div class="wrap nav">
      <a href="#" class="brand"><span class="leaf">🌿</span> <?php echo $company; ?></a>
      <nav class="nav-links">
        <a href="#services">Services</a>
        <a href="#about">About</a>
        <a href="#impact">Impact</a>
        <a href="#contact">Contact</a>
      </nav>
      <div class="nav-cta">
        <a href="#contact" class="btn btn-ghost">Sign in</a>
        <a href="#contact" class="btn btn-primary">Get started</a>
      </div>
    </div>
  </header>

  <!-- Hero -->
  <section class="hero">
    <div class="wrap hero-grid">
      <div>
        <span class="eyebrow">🌱 Sustainable farming since 1998</span>
        <h1>Growing better food for a healthier tomorrow.</h1>
        <p>We combine traditional care with modern agricultural science to deliver premium, responsibly-grown produce — from our fields to your table.</p>
        <div class="hero-actions">
          <a href="#services" class="btn btn-primary">Explore our work →</a>
          <a href="#about" class="btn btn-ghost">Our story</a>
        </div>
        <div class="hero-stats">
          <div><div class="num">25+</div><div class="lbl">Years farming</div></div>
          <div><div class="num">3,200</div><div class="lbl">Acres cultivated</div></div>
          <div><div class="num">100%</div><div class="lbl">Pesticide-free</div></div>
        </div>
      </div>
      <div class="hero-art">
        <div class="badge">
          <span class="dot">🌾</span>
          <div>
            <strong>Harvest-fresh, every season</strong>
            <span>Certified organic &amp; locally sourced</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Trusted strip -->
  <div class="strip">
    <div class="wrap">
      <span>GreenLeaf Co-op</span>
      <span>Harvest Market</span>
      <span>PureFarm</span>
      <span>EarthGrocer</span>
      <span>NaturePlate</span>
    </div>
  </div>

  <!-- Services -->
  <section id="services">
    <div class="wrap">
      <div class="section-head">
        <span class="eyebrow">What we do</span>
        <h2>Agriculture, done responsibly</h2>
        <p>End-to-end solutions that nurture the soil, support our growers, and bring quality produce to communities.</p>
      </div>
      <div class="cards">
        <div class="card">
          <div class="ic">🌽</div>
          <h3>Crop Cultivation</h3>
          <p>Seasonal grains, vegetables and fruit grown with regenerative practices that keep soil rich and yields strong.</p>
        </div>
        <div class="card">
          <div class="ic">💧</div>
          <h3>Smart Irrigation</h3>
          <p>Precision water management with sensor-driven systems that cut waste while keeping every field thriving.</p>
        </div>
        <div class="card">
          <div class="ic">🚜</div>
          <h3>Modern Machinery</h3>
          <p>A well-maintained fleet and skilled operators ensure efficient planting, tending and harvesting at scale.</p>
        </div>
        <div class="card">
          <div class="ic">🐄</div>
          <h3>Livestock Care</h3>
          <p>Ethically raised, free-grazing livestock supported by veterinary oversight and humane standards.</p>
        </div>
        <div class="card">
          <div class="ic">📦</div>
          <h3>Farm-to-Market</h3>
          <p>Cold-chain logistics that move produce from harvest to shelf within hours, locking in freshness.</p>
        </div>
        <div class="card">
          <div class="ic">🌍</div>
          <h3>Sustainability</h3>
          <p>Carbon-conscious operations, crop rotation and zero-waste programs that protect the land for generations.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- About -->
  <section id="about" style="background: var(--sand);">
    <div class="wrap split">
      <div class="art"></div>
      <div>
        <span class="eyebrow">Our story</span>
        <h2>Rooted in the land, focused on the future</h2>
        <p>For over two decades, <?php echo $company; ?> has been family-run and community-minded. We believe great food starts with healthy soil and fair treatment of the people who grow it.</p>
        <p>Today we pair that heritage with data-driven farming — so every acre is more productive, more sustainable, and kinder to the planet.</p>
        <ul class="checklist">
          <li><span class="tick">✓</span> Certified organic across all primary crops</li>
          <li><span class="tick">✓</span> Fair wages and year-round support for our growers</li>
          <li><span class="tick">✓</span> 40% lower water use through precision irrigation</li>
          <li><span class="tick">✓</span> Full traceability from seed to shelf</li>
        </ul>
      </div>
    </div>
  </section>

  <!-- Impact band -->
  <section id="impact">
    <div class="wrap">
      <div class="band">
        <div class="band-grid">
          <div><div class="num">3,200+</div><div class="lbl">Acres under cultivation</div></div>
          <div><div class="num">180</div><div class="lbl">Local farmers supported</div></div>
          <div><div class="num">12M kg</div><div class="lbl">Produce harvested yearly</div></div>
          <div><div class="num">40%</div><div class="lbl">Less water per harvest</div></div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section id="contact" class="cta">
    <div class="wrap">
      <div class="cta-box">
        <span class="eyebrow">Let's grow together</span>
        <h2>Partner with a farm you can trust</h2>
        <p>Whether you're a grocer, restaurant, or distributor, we'd love to bring fresh, responsibly-grown produce to your table.</p>
        <div class="hero-actions" style="justify-content:center;">
          <a href="mailto:hello@verdantfields.example" class="btn btn-primary">Contact our team</a>
          <a href="#services" class="btn btn-ghost">View services</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <div class="wrap">
      <div class="foot-grid">
        <div>
          <div class="brand"><span class="leaf">🌿</span> <?php echo $company; ?></div>
          <p style="max-width:32ch;">Sustainable agriculture and premium produce, grown with care since 1998.</p>
        </div>
        <div>
          <h4>Company</h4>
          <ul>
            <li><a href="#about">About us</a></li>
            <li><a href="#impact">Our impact</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#contact">Careers</a></li>
          </ul>
        </div>
        <div>
          <h4>Resources</h4>
          <ul>
            <li><a href="#">Sustainability report</a></li>
            <li><a href="#">Certifications</a></li>
            <li><a href="#">Blog</a></li>
            <li><a href="#">FAQ</a></li>
          </ul>
        </div>
        <div>
          <h4>Contact</h4>
          <ul>
            <li><a href="mailto:hello@verdantfields.example">hello@verdantfields.example</a></li>
            <li><a href="tel:+10000000000">+1 (000) 000-0000</a></li>
            <li>Greenvale, Countryside</li>
          </ul>
        </div>
      </div>
      <div class="foot-bottom">
        <span>© <?php echo $year; ?> <?php echo $company; ?>. All rights reserved.</span>
        <span>Privacy · Terms · Cookies</span>
      </div>
    </div>
  </footer>

</body>
</html>
