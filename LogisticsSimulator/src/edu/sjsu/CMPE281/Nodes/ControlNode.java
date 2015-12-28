package edu.sjsu.CMPE281.Nodes;

import java.util.Random;

import edu.sjsu.CMPE281.Constants;

public class ControlNode
{
	private SensorNode[] sensorNodes = null;
	private int noOfSensorNodes = Constants.NO_OF_SENSOR_NODES / Constants.NO_OF_CONTROL_NODES;
	private String controlNodeId = null;
	private String truckId = null;
	public boolean isGPSSensorSet = false;

	public void init(int cIndex)
	{
		// random truck-id
		Random r = new Random();
		truckId = Constants.US_STATE_CODES[r.nextInt(Constants.US_STATE_CODES.length)] + r.nextInt(999) + r.nextInt(999);

		int append = (int)(System.currentTimeMillis() % 10000) + cIndex;
		controlNodeId = "CONTROL_NODE_" + append;
		sensorNodes = new SensorNode[noOfSensorNodes];

		for (int sIndex = 0; sIndex < noOfSensorNodes; sIndex++)
		{
			sensorNodes[sIndex] = new SensorNode();
			sensorNodes[sIndex].init(sIndex + append, this);
		}
	}

	public String getContolNodeId()
	{
		return controlNodeId;
	}

	public String getTruckId()
	{
		return truckId;
	}

	public SensorNode[] getSensorNodes()
	{
		return sensorNodes;
	}

	public Sensor getSensorById(String sensorId)
	{
		Sensor sensor = null;
		for (int sIndex = 0; sIndex < noOfSensorNodes; sIndex++)
		{
			if ((sensor = sensorNodes[sIndex].getSensorById(sensorId)) != null)
			{
				break;
			}
		}
		return sensor;
	}

	public void update(long time)
	{
		for (int sIndex = 0; sIndex < noOfSensorNodes; sIndex++)
		{
			sensorNodes[sIndex].update(time);
		}
	}
}