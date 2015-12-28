package edu.sjsu.CMPE281.ServerComponent;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;

import org.apache.http.HttpResponse;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.entity.StringEntity;
import org.apache.http.impl.client.DefaultHttpClient;
import org.json.JSONObject;

public class ConnectionUtility
{
	public static String transmitData(String url, JSONObject sensorData)
	{
		System.out.println("request---" + url + "?req=" + sensorData.toString());
		HttpClient httpClient = new DefaultHttpClient();

		try
		{
			HttpPost request = new HttpPost(url);
			StringEntity params = new StringEntity("req=" + sensorData.toString());
			request.addHeader("content-type", "application/x-www-form-urlencoded");
			request.setEntity(params);
			HttpResponse response = httpClient.execute(request);

			return parseResponseData(response);
		} catch (Exception ex)
		{
		}

		return null;
	}

	public static String receiveData(String url, String query)
	{
		String charset = "UTF-8";

		try
		{
			HttpURLConnection httpConnection = (HttpURLConnection) new URL(url + "?" + query).openConnection();
			httpConnection.setRequestProperty("Accept-Charset", charset);

			InputStream response = httpConnection.getInputStream();

			httpConnection.disconnect();

			return parseResponseData(response);
		} catch (IOException e)
		{
			e.printStackTrace();
		}

		return null;
	}

	public static String parseResponseData(HttpResponse response)
	{
		String line = "";
		StringBuffer buffer = new StringBuffer();
		try
		{
			BufferedReader rd = new BufferedReader(new InputStreamReader(response.getEntity().getContent()));

			while ((line = rd.readLine()) != null)
			{
				// Parse our JSON response
				buffer.append(line + "\n");
			}
		} catch (IOException e)
		{
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		return buffer.toString();
	}

	public static String parseResponseData(InputStream response)
	{
		StringBuffer buffer = new StringBuffer();

		try
		{
			int i = 0;
			while ((i = response.read()) != -1)
			{
				buffer.append((char) i);
			}
		} catch (IOException e)
		{
			e.printStackTrace();
		}

		return buffer.toString();
	}
}
