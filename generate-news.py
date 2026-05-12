import json, os

with open('news.json') as f:
    data = json.load(f)

os.makedirs('news', exist_ok=True)

with open('_article_template.html') as f:
    TEMPLATE = f.read()

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
        <div class="event-field"><label>Date</label><span>{article["event_date"]}</span></div>
        <div class="event-field"><label>Location</label><span>{article["event_location"]}</span></div>
        {link_html}
      </div>
    </div>'''

    html = TEMPLATE
    html = html.replace('ARTICLE_TITLE', article['title'])
    html = html.replace('ARTICLE_DATE', article['date_display'])
    html = html.replace('ARTICLE_IMAGE', article['image'])
    html = html.replace('ARTICLE_CATS', cats_html)
    html = html.replace('ARTICLE_BODY', body_html)
    html = html.replace('ARTICLE_EVENT', event_html)

    with open(f'news/{slug}.html', 'w') as f:
        f.write(html)
    print(f'✅ news/{slug}.html')

print(f'\nGenerated {len(data["articles"])} articles')
