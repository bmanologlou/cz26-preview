I need your help to set up and send an email campaign in Twilio SendGrid (Marketing → Single Sends). I'm already logged in at https://mc.sendgrid.com/single-sends. Go step by step, and **stop to ask me before clicking the final "Send" / "Schedule" button.**

## Campaign details
- **Single Send name:** Automechanika Shanghai 2026 (AMS26)
- **Subject:** ⚡ Explore What's New with Carbon Zapp! 🚀 Visit Us at Automechanika Shanghai 2026, Hall 2.1, Booth G48
- **Preheader:** leave empty, unless the previous campaign had one; if it did, tell me and suggest a new one
- **Recipients list:** [2] All_Verified_users (semi-auto) (that list only; do not add segments or other lists)
- **Sender, unsubscribe group, tracking settings:** the same as the previous Carbon Zapp newsletter (AAPEX 2026)

## Steps
1. On the Single Sends page, find the previous AAPEX 2026 newsletter ("Meet Carbon Zapp at #AAPEX2026!"). If it can be duplicated, **duplicate it** so the sender, unsubscribe group and list carry over. Otherwise create a new Single Send → Blank Template → **Code Editor**, and copy the sender and unsubscribe group from the AAPEX one.
2. Rename it and set the subject as above.
3. Open the **Code Editor**, select all the existing HTML, delete it, and paste in exactly the HTML at the bottom of this message. Do not reformat it or let the editor "fix" it.
4. Check the preview. It should be one tall image (white background, Carbon Zapp logo top-left, "02-05 DEC 2026 SAVE THE DATE" top-right, red footer). If the image is broken, stop and tell me.
5. Settings panel: confirm Sender, the list **[2] All_Verified_users (semi-auto)**, and the unsubscribe group. Report the recipient count SendGrid shows.
6. Send a **test email** to georgedanilopoulos@gmail.com, then tell me it's sent and wait.
7. **Do not send to the list** until I reply "send it". Then click Send (send immediately, not scheduled), and confirm the final status.

If SendGrid shows a warning (missing unsubscribe link, missing address, spam check, etc.), stop and tell me the exact message. Don't work around it on your own.

## HTML to paste
```html
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>&#9889; Explore What's New with Carbon Zapp! &#128640; Visit Us at Automechanika Shanghai 2026, Hall 2.1, Booth G48</title>
	</head> 
	<body style="margin:0 auto; padding:0; line-height: 0; background-color: #ffffff;">
		<table style="border-collapse:collapse; border-spacing: 0; width: 800px; margin: 0 auto;" cellpadding="0" cellspacing="0">
			<tr>
				<td style="width: 800px; margin: 0 auto;"><img src="https://carbonzapp.com/newsletters/ams_26/EO_CZ_AMS_2026_final.png" usemap="#image-map"></td>
			</tr>
		</table>
		<map name="image-map">
			<area target="_blank" alt="Carbonzapp" title="Carbonzapp" href="https://carbonzapp.com/" coords="66,44,362,110" shape="rect">
			<area target="_blank" alt="Automechanika Shanghai" title="Automechanika Shanghai" href="https://automechanika-shanghai.hk.messefrankfurt.com/shanghai/en.html" coords="58,374,328,440" shape="rect">
			<area target="_blank" alt="Download the brochure" title="Download the brochure" href="https://carbonzapp.com/assets/pdfs/CZ_Product_Catalog.pdf" coords="650,724,702,772" shape="rect">
			<area target="_blank" alt="Download the brochure" title="Download the brochure" href="https://carbonzapp.com/assets/pdfs/CZ_Product_Catalog.pdf" coords="650,776,766,1012" shape="rect">
			<area target="" alt="Talk to our Sales Team" title="Talk to our Sales Team" href="mailto:sales@carbonzapp.com" coords="62,1461,287,1535" shape="rect">
			<area target="_blank" alt="View our Product Catalog" title="View our Product Catalog" href="https://carbonzapp.com/assets/pdfs/CZ_Product_Catalog.pdf" coords="289,1461,514,1535" shape="rect">
			<area target="_blank" alt="Find your Local Representative" title="Find your Local Representative" href="https://carbonzapp.com/assets/pdfs/CZ_GLOBAL_REPR.pdf" coords="516,1461,741,1535" shape="rect">
			<area target="_blank" alt="FACEBOOK" title="FACEBOOK" href="https://www.facebook.com/CarbonZapp/" coords="88,1662,111,1687" shape="rect">
			<area target="_blank" alt="YouTube" title="YouTube" href="https://goo.gl/3rN6DP" coords="121,1662,149,1687" shape="rect">
			<area target="_blank" alt="LinkedIN" title="LinkedIN" href="https://www.linkedin.com/company/carbonzapp/" coords="159,1662,182,1687" shape="rect">
			<area target="_blank" alt="INSTAGRAM" title="INSTAGRAM" href="https://www.instagram.com/carbonzapp/" coords="195,1662,219,1687" shape="rect">
			<area target="_blank" alt="Web Version" title="Web Version" href="https://carbonzapp.com/newsletters/ams_26" coords="554,1753,636,1770" shape="rect">
			<area target="_blank" alt="" title="" href="{{{unsubscribe}}}" coords="646,1753,711,1770" shape="rect">
		</map>
	</body>
</html>
```
