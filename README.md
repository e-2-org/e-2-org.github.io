e-2.org
=======

The e-2 website, as a Jekyll site for GitHub Pages. It is the organisation site: e-2's projects are published from their own repositories in the organisation, and appear under this site's domain (e-2.org/c-ship/, e-2.org/wordperhect/ etc.).

Content
-------

* `_projects/` and `_commissions/`: one file per project or commission. The front matter has the heading, subheading, picture (and where it links to), supporters' logos, and the project's place and label in the lists on the home page. The text is the body.
* `index.html`, `projects/index.html`, `commissions/index.html`: the lists, made from the collections in order.
* `about/index.html`, `contact.html`: the about and contact pages.
* `redirects/`: pages which redirect old paths (`/perhect/`, `/projman/`), which the old server did with `.htaccess`.
* `commissions/perhect-launch-360.html`: a QuickTime VR panorama of the Word Perhect installation, kept as it was. Browsers can no longer play QuickTime VR.

Layout and styles
-----------------

* `_layouts/default.html`: the page, with `_includes/footer.html`.
* `_layouts/item.html`: a project or commission.
* `_includes/list.html`: the list of projects or commissions.
* `css/e-2.css`: plain CSS (with nesting), loading `css/modules/` (colours as custom properties, normalize) and `css/partials/` with `@import`. Breakpoints are written into the media queries (800px and 1200px, 460px for the footer), as custom properties can't be used there.

Running it locally
------------------

```
bundle install
bundle exec jekyll serve
```
