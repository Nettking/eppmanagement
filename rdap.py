import requests
import json

def get_domain_info(domain):
    url = f"https://rdap.norid.no/domain/{domain}"
    response = requests.get(url)
    
    if response.status_code == 200:
        return response.json()
    else:
        print(f"Failed to retrieve data: {response.status_code}")
        return None

def print_domain_info(data):
    if data:
        print(f"Domain Handle: {data.get('handle')}")
        print(f"Domain Name: {data.get('ldhName')}")
        
        print("\nEntities:")
        for entity in data.get('entities', []):
            print(f"  Handle: {entity.get('handle')}")
            for vcard in entity.get('vcardArray', [[], []])[1]:
                if vcard[0] == 'fn':
                    print(f"  Name: {vcard[3]}")
                if vcard[0] == 'email':
                    print(f"  Email: {vcard[3]}")
                if vcard[0] == 'tel':
                    print(f"  Phone: {vcard[3]}")
            print("\n")

        print("Events:")
        for event in data.get('events', []):
            print(f"  {event.get('eventAction').capitalize()}: {event.get('eventDate')}")

        print("\nNameservers:")
        for ns in data.get('nameservers', []):
            print(f"  Nameserver: {ns.get('ldhName')}")
            for event in ns.get('events', []):
                print(f"    {event.get('eventAction').capitalize()}: {event.get('eventDate')}")

domain = "vsn.no"
domain_info = get_domain_info(domain)
print_domain_info(domain_info)
