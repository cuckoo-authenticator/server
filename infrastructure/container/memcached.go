package container

import "github.com/bradfitz/gomemcache/memcache"

func createMemcachedClient(ip string, port string) *memcache.Client {
	mc := memcache.New(ip + ":" + port)

	return mc
}
