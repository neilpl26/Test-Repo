import requests
import git
import random
from datetime import datetime
import sys
import os



def upsert_dashboard(  dashboard_id: str, dashboard_title: str, tos: str,  widgets_to_upsert: list = [] ):
    API_KEY = os.getenv("API_KEY")
    BASE_URL = 'https://tezzela.com/api/v1'
    HEADERS = {'X-API-KEY': API_KEY, 'Content-Type': 'application/json'}

    dashboard = {
        "data":
        {
            "id": dashboard_id,
            "to": tos,
            "title": dashboard_title,
            "widgets": widgets_to_upsert
        }
    }

    response = requests.post(f'{BASE_URL}/dashboards/static', headers=HEADERS, json=dashboard)
    
def tezz_aws():
    tos = ['neilpl26@gmail.com']
    widgets = []


    script_dir = os.path.dirname(os.path.abspath(__file__))
    repo_root = os.path.dirname(script_dir)
    repo = git.Repo(repo_root)

    commits = list(repo.iter_commits('master'))
    
    widgets.append(
        {
            "id": "commits-en-test-repo",
            "type": "text",
            "title": "Commits al repo",
            "value": str(len(commits)),
            "sub": "en total"
        }
    )

    upsert_dashboard("test-github-actions", "Estado", tos, widgets)

tezz_aws()