page.meta {
    # abstract
    abstract.data = levelfield :-1, abstract, slide
    abstract.override.data = page:abstract
    abstract.ifEmpty = {$plugin.tx_themes.confirguration.meta.defaults.abstract}
    abstract.abstract = 1

    # keywords
    keywords.data = levelfield :-1, keywords, slide
    keywords.override.data = page:keywords
    keywords.ifEmpty = {$plugin.tx_themes.confirguration.meta.defaults.keywords}
    keywords.keywords = 1

    # description
    description.data = levelfield :-1, description, slide
    description.override.data = page:description
    description.ifEmpty = {$plugin.tx_themes.confirguration.meta.defaults.description}
    description.description = 1

    # author
    author.data = levelfield :-1, author, slide
    author.override.data = page:author
    author.ifEmpty = {$plugin.tx_themes.confirguration.meta.defaults.author}
    author.author = 1

    # publisher
    publisher.data = levelfield :-1, author, slide
    publisher.override.data = page:author
    publisher.ifEmpty = {$plugin.tx_themes.confirguration.meta.defaults.author}
    publisher.publisher = 1

    # author email
    author_email.data = levelfield :-1, author_email, slide
    author_email.override.data = page:author_email
    author_email.ifEmpty = {$plugin.tx_themes.confirguration.meta.defaults.authorEmail}
    author_email.author_email = 1

    # other
    copyright = {$plugin.tx_themes.confirguration.meta.copyright}
    robots = {$plugin.tx_themes.confirguration.meta.robots}
    revisit-after = {$plugin.tx_themes.confirguration.meta.revisitAfter}
    application-name = {$plugin.tx_themes.confirguration.meta.applicationName}
}