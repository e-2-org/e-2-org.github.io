# e-2 and c-ship to Jekyll - session transcript

Transcript of a Claude Code session on 2026-10-08, converting e-2.org and container-ship to Jekyll for GitHub Pages, and a follow-up on 2026-10-12 (the Word Perhect panorama, in the e-2 copy only). The 2026-10-08 part is in both repositories (`e-2` and `c-ship`). Tool calls are shown as one-line notes; their output is omitted. Message times weren't recorded, so only the date is given. Claude's longer replies are shortened where they repeat what the summaries record.

---

## User - 2026-10-08

My next project is converting the website of my old organisation (e-2.org) to a jekyll site so I can move it to GitHub Pages. This will form an organisation site, with projects in organisation repos. The current site is flat HTML in ~/repos/e-2. The other port I want to do to jekyll is one of the umbrella projects (~/repos/c-ship) where some of the projects were hosted.

## Claude

I'll start by looking at both sites: their size, structure, and how the pages are built.

> *Bash: Survey the e-2 and c-ship site folders*

> *Bash: List e-2 pages and build files*

> *Bash: Read e-2 home page, a commission page and the JS*

Every e-2 page shares the same skeleton: a two-column layout, the same footer, and analytics, with only the column contents changing.

> *Bash: Read the body of each e-2 page type*

> *Bash: List c-ship pages, folders and build files*

> *Bash: Summarise c-ship's hosted projects*

> *Bash: Read c-ship home and intro pages*

> *Bash: Read c-ship section and a container page*

I have enough to see the shape of both sites, but a few decisions are yours.

- **e-2:** 27 pages, a 2018 two-column design with SCSS. Two lists, projects (9) and commissions (11). Many links point at subdomains, redirected by `.htaccess`, which GitHub Pages can't do. One page is a QuickTime VR panorama.
- **c-ship:** 24 pages from 1998 (image-based table layouts, rollovers, a Flash intro, server-side image maps), plus eight hosted artworks in `projects/`.

> *AskUserQuestion: URLs, c-ship's look, where the artworks live, dead technology*

Answers: paths under e-2.org; c-ship modernised in the same spirit; each artwork in its own repo; dead technology kept and noted for later.

> *Bash: Check repo state, remotes and Jekyll tooling*

## User (sent while Claude was working) - 2026-10-08

The c-ship site contains some of the projects, which I want to move to different repositories (the VRML and Flash are projects) so please ignore these fo0r now

## Claude

Understood. I'll leave everything in `c-ship/projects/` alone; the c-ship work covers only the container-ship pages themselves.

> *Bash: Extract e-2 page contents and style references*

> *Bash: Read navigation and layout styles*

My plan for e-2 on a new `jekyll` branch: each project and commission becomes a document in `_projects/` or `_commissions/`; the home and index pages list from the collections; one layout and footer include replace the copied markup; Jekyll compiles the SCSS; launch links stay as they are for now.

> *Bash: Create branch and move SCSS into Jekyll's places*

## User (sent while Claude was working) - 2026-10-08

I've made a start on some of the projects I'm most familiar with

## Claude

Noted. Before going further, I'll check what you've started, so I don't duplicate it or conflict with it.

> *Bash: Check the project repos you've started*

## User (sent while Claude was working) - 2026-10-08

I'll treat Tome and other projects as separate task. each managed in their own repositories

## Claude

Understood: this job covers only the e-2 site and the c-ship container-ship pages. I can't see your start in `bird-island`, `minus20` or `contact` (their latest commits are from 2018), so I assume it's elsewhere. Nothing here conflicts with it.

> *Bash: Convert project and commission pages to collection docs*

> *Bash: Remove the old flat pages and node build files*

> *Bash: Write config, Gemfile and CNAME; add SCSS front matter*

> *Bash: Write layouts, list and footer includes*

> *Bash: Write home, index, about and contact pages; recreate projects index and build the site*

> *Bash: Screenshot original and Jekyll e-2 side by side*

> *Read: side-by-side screenshots*

> *Bash: Pixel-compare every page at two widths*

> *Bash: Inspect the one page that differs; compare bird island logo markup*

Bird island has a second column block after the first one's end marker, which the converter missed. I'll add its logo to the front matter.

> *Bash: Add bird island logo and recheck*

## User (sent while Claude was working) - 2026-10-08

I'd rather the CSS was plain CSS (with nesting) with the partials and modules loaded using import

## Claude

Understood: plain CSS using native nesting, with the partials pulled in by CSS `@import`, and no Sass.

> *Bash: Find Sass-only features in the styles*

No mixins or functions, just variables, nesting and nested media queries. Colours become custom properties; breakpoints become literal values in the media queries (custom properties can't be used there); the disabled legacy blocks in normalize are dropped; the unused `_navigation_old` partial is left out.

> *Bash: Convert SCSS partials to plain CSS files*

> *Bash: Switch to plain CSS imports and recheck all pages (git rm refused part way)*

> *Bash: Remove Sass sources properly and recheck all pages*

> *Bash: Locate and zoom the logo difference*

Progress update: e-2 now builds with Jekyll and plain CSS, and every page matches the original pixel for pixel at 1200, 800 and 400px wide, except bird island's Arts Council logo, which now sits 16px higher, consistent with the other pages.

> *Bash: Add redirect pages and update .gitignore*

> *Write: README.md (e-2)*

> *Bash: Screenshot every c-ship page; contact sheet*

> *Read: contact sheet*

> *Bash: Screenshot the deck page and read its markup*

The deck is a 1998 table of image slices. I'll measure where every slice sits in the original, then place them in one scalable deck, with the containers as real links named after the artists.

> *Bash: Outline the content of an artist pair and a room; check apgo, indexold and the deck's pop-up functions*

> *Bash: Measure deck slice positions and hover images*

> *Bash: Read hover preview images and create the branch*

> *Bash: Write the deck's data file from the measurements*

> *Bash: Add light hovers and check for BeautifulSoup*

> *Bash: Extract artist pages, room content and work pages*

> *Bash: Generate c-ship's room, artist and work documents (fixes: credit labels, the bridge's content, rows without links, YAML lists)*

> *Bash: Check button images; contact sheet*

> *Read: button images*

The buttons are coloured dots that reveal a label on hover. The deck can do all its hover effects in plain CSS with `:has()`.

> *Bash: Write c-ship config, Gemfile and base layout*

> *Bash: Write room, artist and work layouts*

> *Bash: Write note layout, deck, front page; remove old pages*

> *Bash: Check c-ship's existing CSS (unused style.css and tabs.css left as they are)*

> *Bash: Write c-ship's CSS and build the site*

> *Bash: Screenshot the new c-ship at two widths*

> *Read: screenshots*

The artist and work pages rendered navy: the base layout read `page.theme`, where a layout's own front matter is `layout.theme`. Fixed.

> *Bash: Fix layout theme lookup and re-screenshot*

> *Bash: Test deck hover panels and keyboard focus*

> *Read: hover screenshots*

> *Write: README.md (c-ship)*

> *Bash: Stage both branches; remove the temporary comparison worktree*

Both sites are now Jekyll sites ready for GitHub Pages, each on a new `jekyll` branch, staged but not committed, both with plain CSS (nesting, `@import`).

- **e-2:** collections for projects and commissions; same URLs; pixel-identical to the original except bird island's logo; redirect pages for `/perhect/` and `/projman/`; gulp, npm, `js/e-2.js` and the old Analytics removed; `CNAME` added.
- **c-ship:** the deck from its 29 original slices, scaling with the window and lighting up on hover or keyboard focus; rooms, artist and work pages rebuilt with their original lettering; same URLs; `projects/`, the Flash and FutureSplash intros and `apgo.html` untouched.
- **Noted for later:** the Flash intros, the QuickTime VR panorama, and e-2's launch links, which still point at the current subdomains.

## User - 2026-10-08

Can you make an SVG from images/logos/e2_160.gif and use that instead

## Claude

I'll look at the logo first, and check whether a tracing tool is available.

> *Bash: Inspect the logo GIF and tracing tools*

> *Read: the logo at 8x*

The logo is simple enough to rebuild as clean vectors: a black-outlined pill, white on the left and grey (#999) on the right, "e-2" in a bold sans-serif and "ORG" in white. I'll set the lettering in a Helvetica-like font and convert it to outlines.

> *Bash: Find a Helvetica-like bold font (Nimbus Sans Bold)*

> *Bash: Measure the logo's parts in the GIF*

> *Bash: Build the SVG logo and compare with the GIF*

> *Read: comparison*

Progress update: the lettering lines up; the original's ends are flatter ellipses, so the outline gets elliptical corners.

> *Bash: Use elliptical ends and recompare*

> *Bash: Use the SVG in the footer and screenshot it (the test server lacked the SVG type; fixed)*

> *Read: footer screenshot*

> *Bash: Stage the new logo and footer change*

The footer now uses `images/logos/e2.svg`: a pill rebuilt from the GIF's measurements, with "e-2" and "ORG" as Nimbus Sans Bold outlines fitted to the GIF's letters, 2.4KB at 160×46. The old GIF is unused but left in place.

## User - 2026-10-08

I've made a couple of adjustments

## Claude

> *Bash: Show unstaged changes in e-2 and c-ship*

> *Bash: Render the edited logo beside the GIF and my version*

> *Read: comparison*

Your edits read well: the slanted hyphen, the narrower "r" and the square dot on the colour split are closer to the original. One thing the Inkscape optimisation broke: the `<title>` element's id became `b`, but `aria-labelledby` still says `e2-logo-title`. It doesn't matter while the logo is an `<img>`, but would if the SVG were inlined. `e2-inkscape.svg` is untracked: commit it as the source, or ignore it?

## User - 2026-10-08

OK that's it for today - please create a summary and transcript like before in the e-2 and c-ship repository folders under _sessions

## Claude

> *Write: _sessions/2026-10-08-transcript.md (e-2 and c-ship)*

> *Write: _sessions/2026-10-08-summary.md (e-2)*

> *Write: _sessions/2026-10-08-summary.md (c-ship)*

I've written a summary to each repo's `_sessions` folder, and this transcript to both.

---

# Session of 2026-10-12

## User - 2026-10-12

Is it possible to convert the images/commissions/perhect-launch-360.mov file to a format which can be played in modern browsers?

## Claude

Very likely, yes. A QuickTime VR panorama isn't a video: it's a panoramic picture stored as tiles inside the `.mov`. If the tiles can be decoded, they can be stitched back into one panoramic image and shown with a JavaScript panorama viewer.

> *Bash: Inspect the QuickTime VR file*

ffmpeg can decode the picture tiles: Cinepak, 1384×100 per frame, about 50 tiles. Each frame is a vertical strip of the panorama turned on its side.

> *Bash: Extract the tiles and join them both ways round*

> *Read: both arrangements*

The second arrangement is continuous, but upside down; the drawn interface on the wall ("WRITE SOMETHING RUDE") shows which way round is right.

> *Bash: Turn the panorama upright and crop a detail*

> *Read: the panorama and a detail*

Yes, and the picture recovers completely: a 5000×1384 cylindrical 360° panorama of the installation at Chisenhale Gallery, with no visible seams. I recommend showing it in Pannellum, a small open-source panorama viewer, with the image reprojected so straight lines stay straight (about 1–2MB). The simpler alternative is a flat strip to scroll or drag round. Shall I go ahead with Pannellum?

## User - 2026-10-12

That sounds great - use Panellum to make the interactive 360, but can you also make the strip so I can take a look at it?

## Claude

First I'll look in the file for QuickTime VR's own panorama settings.

> *Bash: Read the QuickTime VR panorama settings*

The settings are there: pan 0–360°, tilt ±41.01°, field of view 12.3–82.0° (starting at 60.7°), starting pan 313.3°. The tilt matches the image's geometry, so the horizon is centred.

> *Bash: Make the equirectangular and strip JPEGs*

The computed vertical angle, 82.02°, matches the file's stored value exactly. The images are 468KB (panorama, 4096×933) and 795KB (strip).

> *Bash: Check the Pannellum version on cdnjs; get integrity hashes and current page links*

> *Bash: Write the two panorama pages, styles and link*

> *Bash: Recreate the screenshot script and capture both pages*

> *Read: screenshots*

The strip works. Pannellum only drew in the top of its box, and the heading link was the browser's default blue.

> *Bash: Check the viewer's canvas and try dragging*

Pannellum's own stylesheet sets its container to `height: 100%`, overriding the page's height, so the viewer shrank to its 240px minimum. It now sits in a sized frame.

> *Bash: Size the viewer frame and colour the heading*

> *Read: the viewer, before and after dragging*

> *Bash: Stage the panorama pages and images*

The panorama now plays in modern browsers, and there's a strip version to compare; both are staged on `jekyll`.

- **Viewer** (`commissions/perhect-launch-360.html`, the same address as before, linked again from the commission page): Pannellum 2.5.7 from cdnjs, with drag, touch, keyboard, zoom and full screen. It opens facing the drawn word processor; the original's saved starting direction couldn't be confirmed.
- **Strip** (`commissions/perhect-launch-360-strip.html`): the unprojected panorama, looping endlessly. Not linked: keep it, link to it, or delete it.

## User - 2026-10-12

can you add to the summary and transcript in the e-2 repo please?

## Claude

> *Bash: Find where to add the new session*

> *Bash: Add the 12 October session to the summary and transcript*

I've added this session to the summary and transcript in the e-2 repo.
