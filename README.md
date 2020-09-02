## What should happen

A `<w:br/>` element is generated correctly, which is contained by a `<w:r>` element.

So that every software recognizing DOCX format could happy.

In the `word/document.xml` file inside the DOCX file, it should be as follows:

```xml
<w:p><w:pPr><w:pStyle w:val="Normal"/><w:bidi w:val="0"/><w:jc w:val="left"/><w:rPr></w:rPr></w:pPr><w:r>
  <w:rPr/>
  <w:t xml:space="preserve">Text123</w:t>
</w:r>
<w:r>
    <w:br/>
</w:r>
<w:r>
  <w:rPr/>
  <w:t xml:space="preserve">Text123</w:t>
</w:r>
</w:p>
```



## What actually happened

It is actually as follows:

```xml
<w:p><w:pPr><w:pStyle w:val="Normal"/><w:bidi w:val="0"/><w:jc w:val="left"/><w:rPr></w:rPr></w:pPr><w:r>
  <w:rPr/>
  <w:t xml:space="preserve">Text123</w:t>
</w:r>
<w:br/>
<w:r>
  <w:rPr/>
  <w:t xml:space="preserve">Text123</w:t>
</w:r>
</w:p>
```

As the `<w:br/>` element is NOT inside a `<w:r>` element, which is against the [ECMA-376](https://www.ecma-international.org/publications/standards/Ecma-376.htm) standard (section 17.3.3.1, on Page 323, the Fifth Edition, Part 1. You can download the standard [here](https://www.ecma-international.org/publications/files/ECMA-ST/ECMA-376,%20Fifth%20Edition,%20Part%201%20-%20Fundamentals%20And%20Markup%20Language%20Reference.zip))

Although both Microsoft Word and LibreOffice can stand up with this error, other softwares that follow ECMA-376 can not, for example, [WPS](https://www.wps.com/), the most popular office suite software in China. 

## How to replay this issue

1. PHP v7.0 (or later)

2. Install the latest version of PHPWord (dev-master)

```bash
composer update
```

3. Visit the `test.php` file and download the generated `result.docx` file.