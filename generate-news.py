import json, os

with open('news.json') as f:
    data = json.load(f)

os.makedirs('news', exist_ok=True)

TEMPLATE = '''<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<base href="../">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>{title} — Carbon Zapp</title>
<meta name="description" content="{excerpt}">
<meta property="og:title" content="{title} — Carbon Zapp">
<meta property="og:description" content="{excerpt}">
<meta property="og:image" content="{image}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Public+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/fonts/gunterz.css">
<link rel="stylesheet" href="assets/css/shared.css">
<script src="components.js" defer></script>
<style>
  :root {{ --nav-h: 64px; --accent: #ED1C24; --black: #0a0a0a; --white: #f5f3ef; }}
  *, *::before, *::after {{ box-sizing: border-box; margin: 0; padding: 0; }}
  body {{ background: var(--black); color: var(--white); font-family: "Public Sans", sans-serif; }}

  .article-wrap {{ max-width: 1100px; margin: 0 auto; padding: 0 48px; }}
  .article-hero {{ padding: 120px 0 40px; }}
  .article-cats {{ display: flex; gap: 8px; margin-bottom: 16px; }}
  .article-cat {{ font-family: "DM Mono", monospace; font-size: 10px; letter-spacing: .1em; text-transform: uppercase; color: var(--accent); border: 1px solid rgba(237,28,36,.4); padding: 4px 10px; }}
  .article-title {{ font-family: "Gunterz", sans-serif; font-size: 52px; line-height: 1.05; margin-bottom: 16px; }}
  .article-meta {{ font-family: "DM Mono", monospace; font-size: 11px; color: rgba(245,243,239,.4); letter-spacing: .05em; margin-bottom: 12px; }}

  .article-image {{ padding-bottom: 48px; }}
  .article-image img {{ width: 100%; height: auto; display: block; }}

  .article-body p {{ font-size: 17px; line-height: 1.75; color: rgba(245,243,239,.8); margin-bottom: 24px; }}

  .article-event-info {{ padding-bottom: 48px; }}
  .event-card {{ border: 1px solid rgba(255,255,255,.1); padding: 24px 32px; display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 24px; }}
  .event-field label {{ font-family: "DM Mono", monospace; font-size: 10px; letter-spacing: .1em; text-transform: uppercase; color: rgba(245,243,239,.35); display: block; margin-bottom: 6px; }}
  .event-field span {{ font-size: 14px; color: var(--white); }}
  .event-link {{ margin-top: 8px; grid-column: 1/-1; }}
  .event-link a {{ font-family: "Public Sans", sans-serif; font-size: 11px; font-weight: 600; letter-spacing: .08em; text-transform: uppercase; color: var(--accent); text-decoration: none; border: 1px solid var(--accent); padding: 10px 24px; display: inline-block; transition: background .2s, color .2s; }}
  .event-link a:hover {{ background: var(--accent); color: #fff; }}

  .article-back {{ padding-bottom: 80px; }}
  .article-back a {{ font-family: "DM Mono", monospace; font-size: 11px; letter-spacing: .08em; text-transform: uppercase; color: rgba(245,243,239,.4); text-decoration: none; display: inline-flex; align-items: center; gap: 8px; transition: color .2s; }}
  .article-back a:hover {{ color: var(--white); }}

  /* Newsletter strip */
  .nl-strip {{ background: #0a0a0a; border-top: 1px solid rgba(255,255,255,0.07); padding: 24px 48px 24px 0; display: flex; align-items: center; gap: 0; margin: 0 48px; }}
  .nl-left {{ width: auto; flex-shrink: 0; padding-right: 160px; }}
  .nl-title {{ font-family: "DM Mono", monospace; font-size: 13px; letter-spacing: .1em; color: #ED1C24; text-transform: uppercase; white-space: nowrap; }}
  .nl-right {{ display: flex; align-items: center; gap: 0; flex: 1; }}
  .nl-form {{ display: flex; align-items: center; gap: 8px; width: 356px; flex-shrink: 0; }}
  .nl-input {{ background: transparent; border: none; border-bottom: 1px solid rgba(255,255,255,0.2); color: #f5f3ef; font-family: "Public Sans", sans-serif; font-size: 13px; padding: 6px 0; outline: none; flex: 1; transition: border-color .2s; }}
  .nl-input::placeholder {{ color: rgba(245,243,239,.3); }}
  .nl-btn {{ background: transparent; color: rgba(245,243,239,.55); border: 1px solid rgba(255,255,255,0.2); font-family: "Public Sans", sans-serif; font-size: 10px; font-weight: 600; letter-spacing: .1em; text-transform: uppercase; padding: 7px 16px; cursor: pointer; transition: color .2s, border-color .2s; white-space: nowrap; }}
  .nl-btn:hover {{ color: #ED1C24; border-color: #ED1C24; }}
  .nl-check {{ display: flex; align-items: center; gap: 8px; font-size: 11px; color: rgba(245,243,239,.5); cursor: pointer; white-space: nowrap; margin-left: 48px; }}
  .nl-check input[type="checkbox"] {{ appearance: none; -webkit-appearance: none; width: 13px; height: 13px; border: 1px solid rgba(255,255,255,0.3); background: transparent; cursor: pointer; position: relative; flex-shrink: 0; transition: border-color .2s; }}
  .nl-check input[type="checkbox"]:checked {{ border-color: #ED1C24; background: #ED1C24; }}
</style>
</head>
<body>

<div id="nav-placeholder"></div>

<article>
  <div class="article-hero">
    <div class="article-breadcrumb">
      <a href="cznews.html">News &amp; Events</a>
      <span>›</span>
      {title}
    </div>
    <div class="article-cats">{cats_html}</div>
    <h1 class="article-title">{title}</h1>
    <div class="article-meta">{date_display}</div>
  </div>

  <div class="article-image">
    <img src="{image}" alt="{title}">
  </div>

  <div class="article-body">
    {body_html}
  </div>

  {event_html}

  <div class="article-back">
    <a href="cznews.html">← Back to News &amp; Events</a>
  </div>
</article>

<div id="footer-cta-placeholder"></div>
<div id="footer-placeholder"></div>

</body>
</html>'''

for article in data['articles']:
    slug = article['id']

    cat_labels = {'events': 'Event', 'news': 'News', 'innovation': 'Innovation'}
    cats_html = ''.join(f'<span class="article-cat">{cat_labels.get(c, c)}</span>' for c in article['categories'])

    body_html = ''.join(f'<p>{p.strip()}</p>' for p in article['body'].split('\n\n') if p.strip())

    event_html = ''
    if 'event_date' in article:
        link_html = ''
        if article.get('event_link') and article['event_link'] != '#':
            link_html = f'<div class="event-link"><a href="{article["event_link"]}" target="_blank" rel="noopener">Visit Exhibition Website</a></div>'
        event_html = f'''
  <div class="article-event-info">
    <div class="event-card">
      <div class="event-field">
        <label>Date</label>
        <span>{article["event_date"]}</span>
      </div>
      <div class="event-field">
        <label>Location</label>
        <span>{article["event_location"]}</span>
      </div>
      {link_html}
    </div>
  </div>'''

    html = TEMPLATE.format(
        title=article['title'],
        excerpt=article['excerpt'],
        image=article['image'],
        date_display=article['date_display'],
        cats_html=cats_html,
        body_html=body_html,
        event_html=event_html
    )

    filepath = f'news/{slug}.html'
    with open(filepath, 'w') as f:
        f.write(html)
    print(f'✅ {filepath}')

print(f'\nGenerated {len(data["articles"])} articles')
