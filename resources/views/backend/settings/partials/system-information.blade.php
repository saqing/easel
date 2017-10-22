<div class="card">
    <div class="card-header">
        <h2>System Information
            <small>To best assist you in any issues you encounter, please provide this information (ideally as a link to a <a href="https://gist.github.com/" target="_blank">Gist</a>) when requested by support staff.</small>
        </h2>
    </div>
    <div class="card-body card-padding">
        <pre id="system-info">
            <code>
### Begin System Info ###

## Please include this information when requesting technical support ##

-- Site Info

SITE_URL:                   {{ $data['url'] }}
SITE_IP:                    {{ $data['ip'] }}
SITE_TIMEZONE:              {{ $data['timezone'] }}

-- Webserver Configuration

PHP_VERSION:                {{ $data['phpVersion'] }}
DATABASE_CONNECTION:        {{ $data['dbConnection'] }}
WEB_SERVER:                 {{ $data['webServer'] }}

-- User Browser

User Agent String:          {{ $data['userAgentString'] }}

-- PHP Configuration

PHP_MEMORY_LIMIT:           {{ $data['phpMemoryLimit'] }}
PHP_TIME_LIMIT:             {{ $data['phpTimeLimit'] }}

-- PHP Extensions

cURL:                       {{ $data['curl'] }}
cURL Version:               {{ $data['curlVersion'] }}
GD:                         {{ $data['gd'] }}
PDO:                        {{ $data['pdo'] }}
SQLite:                     {{ $data['sqlite'] }}
OpenSSL:                    {{ $data['openssl'] }}
MBString:                   {{ $data['mbstring'] }}
Tokenizer:                  {{ $data['tokenizer'] }}
Zip:                        {{ $data['zip'] }}

-- Canvas Configuration

CANVAS_VERSION:             {{ $data['version'] }}
LAST_INDEX_RUN:             {{ $data['lastIndex'] }}
THEME:                      {{ $data['active_theme_theme']->getName().' '.$data['active_theme_theme']->getVersion() }}

### End System Info ###
            </code>
        </pre>
    </div>
</div>
