# miraiCTF Writeup
URL: http://167.179.79.239/

## sequel
Link: http://167.179.79.239:1337/b44807062df88c07f51eedf2538ff043/

its just a login sql injection in [login form](http://167.179.79.239:1337/b44807062df88c07f51eedf2538ff043/login.php)

using a payload -> `' or 1=1--`

![](https://i.imgur.com/lh8AIEb.png)

FLAG: **miraiCTF{3aSy_l0gin_SqL_Inject10n}**

## cookie poppers!
Link: http://167.179.79.239:1337/4f33eccad3ab1e772e7f32ff0514cfe0/

In the website, its just the search box that is working.

Testing for XSS and popping a document.cookie as the title says.

![](https://i.imgur.com/ZCF4Htk.png)

FLAG: **miraiCTF{g00d_job_xSs}**

## MD 2+3
Link: http://167.179.79.239:1337/08eef57312ecf3117e9f3896e166a72e/

Viewing the source code

![](https://i.imgur.com/kq9BRgb.png)

Source code:

![](https://i.imgur.com/MzxDW1m.png)

It just simply checking if the submitted password (if hashed to MD5) is equal to `2b4b57f505b581209ed16b97c3c544a9`

Decrypt the MD5 hash and use it to login

![](https://i.imgur.com/tIGbPeQ.png)

FLAG: **miraiCTF{cr4ck1ng_md5?} **


## include a paper wrapper
Link: http://167.179.79.239:3333/

Looking through the link provided it just consist a two pages (Home and About)

In the about page, it just including the `about.php` file and this might be a local file inclusion vulnerabiltiy

![](https://i.imgur.com/wMGAZbv.png)

checking if i can read `/etc/passwd`

![](https://i.imgur.com/07GZl9k.png)

but where is the flag now? looking back on the title "include a paper wrapper". this gives me an idea that we need to use a [PHP Wrappers](https://github.com/payloadbox/rfi-lfi-payload-list#lfi--rfi-wrappers-)

Used a wrapper `php://filter/convert.base64-encode/resource=index.php` to read the `index.php` that convert the contents to BASE64.

![](https://i.imgur.com/s2deT44.png)

Decoding the base64 code and read the code gives us a flag!

![](https://i.imgur.com/9JvoP1N.png)

FLAG: **miraiCTF{y0u_kn0w_wr4pp3rs!}**


## back me up
Link: http://167.179.79.239:1337/97636d24b36f03e782210fcd7afa3de1/

It gives us an empty page

![](https://i.imgur.com/MPgTGJF.png)

Lets do a directory bruteforce with `fuff`.

```bash
ffuf -u http://167.179.79.239:1337/97636d24b36f03e782210fcd7afa3de1/FUZZ -w /usr/share/wordlists/seclists/Discovery/Web-Content/raft-medium-directories.txt
```
![](https://i.imgur.com/afwnWFe.png)

It gives us only 1 result which is a directory named `www`. Opening the directory gives us an SQL file.

![](https://i.imgur.com/UMQECnS.png)

Downloading and reading the contents of it.

![](https://i.imgur.com/AunmAfC.png)

FLAG: **miraiCTF{b4ckups_1s_d4ng3r0us}**


## VC System
Link: http://167.179.79.239:1337/cf7dd3ce51958c5f13fece957cc417fb/

Lets do a recon with `fuff` because the website is empty.

![](https://i.imgur.com/2AxCJED.png)

```bash
ffuf -u http://167.179.79.239:1337/cf7dd3ce51958c5f13fece957cc417fb/FUZZ -w /usr/share/wordlists/seclists/Discovery/Web-Content/raft-small-words.txt
```

![](https://i.imgur.com/kwKe1FB.png)

Everything is `403` aside from `.git` directory. Accessing it gives us an exposed `.git` repository!

![](https://i.imgur.com/JfqntYR.png)

I used [githacker](https://github.com/WangYihang/GitHacker) to download the `git` whole directory.

```bash
githacker --url http://167.179.79.239:1337/cf7dd3ce51958c5f13fece957cc417fb/.git/ --output-folder miraiCTFGIT
```

**git logs**
![](https://i.imgur.com/eZ35vmg.png)

There is so many commit history

Looking through every commit history with `git show [commit id]` command.

![](https://i.imgur.com/C6HDQbz.png)


FLAG: **miraiCTF{m4st3r_0f_g1t}**

## find the RaCE track
Description: `can you check registered users and get my password?`
Link: http://167.179.79.239:2222/

It give us a website where we can ping domains.

![](https://i.imgur.com/AxkuiW0.png)

The title hinting us that this might be a RCE because of "**R**a**CE**".

So looking for ways on how to escalate this pinging thing to RCE.

Looking for payloads [here](https://github.com/payloadbox/command-injection-payload-list), we can use a logical operator `&&`, `|`, or `;` to concatenate our malicious commands. 

![](https://i.imgur.com/ev0tjWj.png)

We can execute commands

Flags in the same directory is fake so where is the flag?

![](https://i.imgur.com/PWCBR2b.png)

The challenge description says "*can you check registered users and get my password?*"

In linux `/etc/passwd` contains the information of registered users. So reading the file with `google.com && cat /etc/passwd` payload

![](https://i.imgur.com/uiPywly.png)

FLAG: **miraiCTF{rc3_1snt_th4t_h4rd!}**

## it extracts
Link: http://167.179.79.239:1337/d41d8cd98f00b204e9800998ecf8427e/

The website needs a passphrase to submit. Checking the source code of it.

![](https://i.imgur.com/SkvpzLU.png)

**SOURCE CODE:** (removed the html)
```php
<?php
include 'flag.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $random = rand();
    extract($_POST);
    
    if($pwd == $random){
        echo('<br><pre style=\"width: 100%\">Congrats! Here is the '.$flag.'</pre>');
    } else {
        echo('<br><pre style=\"width: 100%\">Wrong passphrase!</pre>');
    }
    die;
}
?>
```

**So where is the vulnerable part here?**

The challenge title gives hint as `extract()` function might be vulnerable.

The whole idea of `extract()` vulnerability is we can overwrite or tamper a data to any previously defined variable on the code like the `$random` variable.

read full blog post on *[PHP extract() Vulnerability by David Noren](https://davidnoren.com/post/php-extract-vulnerability/)*

---

To get the flag, we need to set the `$pwd` equal to `$random` which generates a random value. 

**Final payload**
```bash
curl http://167.179.79.239:1337/d41d8cd98f00b204e9800998ecf8427e/ --data 'pwd=ctf&random=ctf'
```

![](https://i.imgur.com/kgacJEl.png)


FLAG: **miraiCTF{3xtr4ct_funct10n_1s_vuln3rbl3}**
