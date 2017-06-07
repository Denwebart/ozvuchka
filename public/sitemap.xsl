<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="2.0"
                xmlns:html="http://www.w3.org/TR/REC-html40"
                xmlns:sitemap="http://www.sitemaps.org/schemas/sitemap/0.9"
                xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" version="1.0" encoding="UTF-8" indent="yes"/>
    <xsl:template match="/">
        <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <title>Sitemap XML</title>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
                <style type="text/css">
                    body {
                        padding: 0 !important;
                        margin: 0 !important;
                        font-family: 'Open Sans', sans-serif;
                        font-weight: 400;
                        border-top: 3px solid rgba(0, 0, 0, 0.10);
                    }
                    a {
                        color: #f55582;
                    }
                    #logo {
                        margin: 25px auto;
                        text-align: center;
                    }
                    #logo .image {
                        display: inline-block;
                        width: auto;
                        margin-bottom: 10px;
                    }
                    #logo .image img {
                    width: 100%;
                    }
                    #logo h1 {
                        margin: 0;
                        font-size: 13px;
                        font-weight: 400;
                        display: inline-block;
                        width: 100%;
                    }
                    #logo h1 a {
                        color: #333333;
                        text-decoration: none;
                    }
                    #logo h1 a:hover {
                        text-decoration: underline;
                    }
                    .content {
                        max-width: 900px;
                        min-width: calc(600px - 2em);
                        margin: 0 auto;
                        padding: 1em;
                    }
                    .content .total {
                        margin-bottom: 10px;
                        display: inline-block;
                        width: 100%;
                    }
                    .content table {
                        width: 100%;
                    }
                    .content tr th {
                        margin: 0 5px;
                        font-weight: 600;
                        white-space: nowrap;
                    }
                    .content tr th span {
                        margin: 0 15px 0 0;
                    }
                    .content tr th,
                    .content tr td {
                        text-align: left;
                        border-bottom: 1px solid #eee;
                        padding-left: 0;
                        padding-right: 0;
                    }
                    #footer {
                        margin: 10px 0 0;
                        min-height: 100px;
                        text-align: center;
                    }
                    #footer .copyright {
                        display: inline-block;
                        line-height: 30px;
                    }
                    #footer .text,
                    #footer .logo {
                        float: left;
                        margin-right: 5px;
                    }
                    #footer .logo {
                        width: 100px;
                        margin-top: 5px;
                    }
                </style>
            </head>
            <body>
                <div id="logo">
                    <xsl:for-each select="sitemap:urlset/sitemap:image">
                        <a href="/" class="image">
                            <img>
                                <xsl:attribute name="src">
                                    <xsl:value-of select="sitemap:url" />
                                </xsl:attribute>
                                <xsl:attribute name="alt">
                                    <xsl:value-of select="sitemap:title" />
                                </xsl:attribute>
                            </img>
                        </a>
                        <a href="/">
                            <h1>
                                <xsl:value-of select="sitemap:title" />
                            </h1>
                            <p><xsl:value-of select="sitemap:slogan" /></p>
                        </a>
                    </xsl:for-each>
                </div>
                <div class="content">
                    <div class="total">
                        <small>This sitemap contains <xsl:value-of select="count(sitemap:urlset/sitemap:url)"/> URLs.</small>
                    </div>
                    <table cellpadding="5">
                        <tr>
                            <th><span>URL</span></th>
                            <th><span>Priority</span></th>
                            <th><span>Change Frequency</span></th>
                            <th><span>Last Change</span></th>
                        </tr>
                        <xsl:variable name="lower" select="'abcdefghijklmnopqrstuvwxyz'"/>
                        <xsl:variable name="upper" select="'ABCDEFGHIJKLMNOPQRSTUVWXYZ'"/>
                        <xsl:for-each select="sitemap:urlset/sitemap:url">
                            <tr>
                                <xsl:if test="position() mod 2 != 1">
                                    <xsl:attribute name="class">high</xsl:attribute>
                                </xsl:if>
                                <td>
                                    <xsl:variable name="itemURL1">
                                        <xsl:value-of select="sitemap:loc"/>
                                    </xsl:variable>
                                    <a href="{$itemURL1}">
                                        <xsl:value-of select="sitemap:loc"/>
                                    </a>
                                </td>
                                <td>
                                    <xsl:value-of select="concat(sitemap:priority*100,'%')"/>
                                </td>
                                <td>
                                    <xsl:value-of
                                            select="concat(translate(substring(sitemap:changefreq, 1, 1),concat($lower, $upper),concat($upper, $lower)),substring(sitemap:changefreq, 2))"/>
                                </td>
                                <td width="150px">
                                    <xsl:value-of
                                            select="concat(substring(sitemap:lastmod,0,11),concat(' ', substring(sitemap:lastmod,12,5)))"/>
                                </td>
                            </tr>
                        </xsl:for-each>
                    </table>
                </div>
                <div id="footer">
                    <div class="copyright">
                        <xsl:for-each select="sitemap:urlset/sitemap:image">
                            <span class="text">
                                <xsl:value-of select="sitemap:copyright" />
                            </span>
                            <a href="/">
                                <span class="text">
                                    <xsl:value-of select="sitemap:siteurl" />
                                </span>
                            </a>
                        </xsl:for-each>
                    </div>
                </div>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>