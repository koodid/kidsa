<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/">
        <xsl:for-each select="posts/post">
            <div class="container-fluid">
                <div class="col-xs-12 col-custom-frontpage col-centered">
                    <xsl:attribute name="data-id">
                        <xsl:value-of select="id"/>
                    </xsl:attribute>
                    <blockquote class="blockquote">
                        <xsl:value-of select="data"/>
                        <footer class="blockquote-footer">
                            <xsl:value-of select="childname"/>,
                            <xsl:value-of select="age"/>
                        </footer>
                        <xsl:choose>
                            <xsl:when test="mylike > 0">
                                <myhiddenbutton>
                                    <xsl:attribute name="onclick">addLike(<xsl:value-of select="id"/>)
                                    </xsl:attribute>
                                    <xsl:attribute name="class">post-<xsl:value-of select="id"/>
                                    </xsl:attribute>
                                    <span class="glyphicon glyphicon-star liked" aria-hidden="true"/>
                                    <span class="like-amount">
                                        <xsl:value-of select="likes"/>
                                    </span>
                                </myhiddenbutton>
                            </xsl:when>
                            <xsl:otherwise>
                                <myhiddenbutton>
                                    <xsl:attribute name="onclick">addLike(<xsl:value-of select="id"/>)
                                    </xsl:attribute>
                                    <xsl:attribute name="class">post-<xsl:value-of select="id"/>
                                    </xsl:attribute>
                                    <span class="glyphicon glyphicon-star" aria-hidden="true"/>
                                    <span class="like-amount">
                                        <xsl:value-of select="likes"/>
                                    </span>
                                </myhiddenbutton>
                            </xsl:otherwise>
                        </xsl:choose>
                    </blockquote>
                </div>
            </div>
        </xsl:for-each>
    </xsl:template>
</xsl:stylesheet>