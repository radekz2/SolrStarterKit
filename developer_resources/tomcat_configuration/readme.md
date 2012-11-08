# How to use this file?
*solr.xml* file is meant to be placed into Tomcat's configuration directory under *Tomcat 6.0\conf\Catalina\localhost*. It will instruct your java webserver to load Solr WAR file (.war) 

You will need edit 2 attributes, docBase in the Context node:

<Context *docBase="C:/SolrStarterKit/tomcat/apache-solr-3.6.1.war"* debug="0" crossContext="true">

and 

