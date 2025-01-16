<?php

namespace FolupExchange;

class CryptoConverter
{
    private $apiUrl = "https://api.coingecko.com/api/v3/simple/price?ids=bitcoin,ethereum,dogecoin,ripple,solana,cardano,polkadot,tron,shiba-inu,uniswap,chainlink,litecoin,stellar,monero,vechain,aave,cosmos,avalanche,algorand,tezos,near,apecoin,filecoin,flow,the-sandbox,decentraland,hedera,elrond,quant,chiliz,theta-fuel,zilliqa,enjin-coin,synthetix,dash,arweave,loopring,neo,bittorrent,newton,basic-attention-token,waxp,icon,bittorrent,bora,sushi,1inch,harmony,mina,ravencoin,nano,kadena,oasis-network,golem,spell-token,ocean-protocol,klaytn,frax-share,celo,convex-finance,gala,ankr,audius,injective-protocol,amp,reserve-rights,moonriver,balancer,cartesi,perpetual-protocol,nucypher,fetch-ai,iohk,venus,ontology,aragon,band-protocol,decred,dydx,metisdao,ens,blur,stepn,api3,safemoon,zksync,storj,keep-network,alchemix,xyo,stormx&vs_currencies=usd,try";
    private $cacheManager;

    public function __construct(CacheManager $cacheManager)
    {
        $this->cacheManager = $cacheManager;
    }

    public function getRates()
    {
        $cacheKey = "crypto_rates";
        if ($this->cacheManager->isCacheValid($cacheKey)) {
            return $this->cacheManager->getCache($cacheKey);
        }

        $data = json_decode(file_get_contents($this->apiUrl), true);
        $this->cacheManager->setCache($cacheKey, $data);

        return $data;
    }

    public function getRate($crypto, $currency)
    {
        $rates = $this->getRates();

        if (!isset($rates[$crypto][$currency])) {
            throw new \Exception("Rate for $crypto in $currency not found.");
        }

        return $rates[$crypto][$currency];
    }
}
